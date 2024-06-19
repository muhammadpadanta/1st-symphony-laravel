<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderTicket;
use App\Models\ConcertTicket;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Milon\Barcode\Facades\DNS1D;
use GuzzleHttp\Client;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderTickets.concertTicket.ticketType')->get();
        return view('order', ['orders' => $orders]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'concert_ticket_id' => 'required|integer|exists:concert_tickets,concert_ticket_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $concertTicketId = $request->concert_ticket_id;
        $quantity = $request->quantity;

            $order = new Order;
            $order->user_id = $userId;
            $order->order_date = now();
            $order->total_amount = 0; // Initial total amount
            $order->purchase_status = 'Pending';
            $order->snap_token = 'temporary';
            $order->save();


        // Add concert tickets to the order
        $concertTicket = ConcertTicket::find($concertTicketId);
        $ticketType = $concertTicket->ticketType;

        $orderTicket = new OrderTicket;
        $orderTicket->order_id = $order->order_id;
        $orderTicket->concert_ticket_id = $concertTicketId;
        $orderTicket->quantity = $quantity;
        $orderTicket->save();

        // Update the total amount of the order
        $order->total_amount += $ticketType->price * $quantity; // Use the price from the ticket type
        $order->save();

        if ($order->total_amount < 0.01) {
            return response()->json(['message' => 'Total amount must be at least 0.01'], 400);
        }

        // Midtrans payment integration
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_id,
                'gross_amount' => $order->total_amount,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function success(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::with('orderTickets.concertTicket.ticketType.concert')->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->purchase_status = 'Success';
        $order->save();

        foreach ($order->orderTickets as $orderTicket) {
            $concertTicket = ConcertTicket::find($orderTicket->concert_ticket_id);
            $concertTicket->total_stock -= $orderTicket->quantity;
            $concertTicket->sold_tickets += $orderTicket->quantity;
            $concertTicket->save();
        }
        $orderTickets = $order->orderTickets;

        $pdf = PDF::loadView('tickets.pdf', ['order' => $order, 'concertTicket' => $order->orderTickets->first()->concertTicket]);
        $pdf->setPaper([0, 0, 300, 600], 'landscape');


        $pdfPath = 'tickets/ticket_' . $order->order_id . '.pdf';
        \Storage::put('public/' . $pdfPath, $pdf->output());


        $userTicket = new UserTicket;
        $userTicket->order_id = $order->order_id;
        $userTicket->ticket_link = 'storage/' . $pdfPath;
        $userTicket->created_at = now();
        $userTicket->save();

        return response()->json(['message' => 'Payment success', 'order' => $order], 200);
    }

    public function cancel(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }

    public function checkStock(Request $request)
    {
        $concertTicketId = $request->input('concert_ticket_id');
        $quantity = $request->input('quantity');

        $concertTicket = ConcertTicket::find($concertTicketId);

        if (!$concertTicket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        if ($concertTicket->total_stock < $quantity) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        return response()->json(['message' => 'Stock is sufficient'], 200);
    }
}
