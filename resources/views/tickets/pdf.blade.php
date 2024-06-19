<!DOCTYPE html>
<html>
<head>
    <title>Order Ticket</title>
    <style>
        .barcode-container {
            float: left;
            width: 20%; /* adjust the width to your liking */
            margin-right: 20px; /* adjust the margin to your liking */
            transform: rotate(90deg);
            margin-top: 80px;
        }

        .barcode-container img {
            width: 100%;
            height: auto;
            object-fit: contain;

        }

        .text {
            border-left: 2px solid black;
            float: right;
            padding-left: 20px;
            width: 70%;
            margin-left: 20px; /* adjust the margin to your liking */
        }

        .image {
            float: right;
            width: 10%; /* adjust the width to your liking */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="barcode-container">
        {!! DNS1D::getBarcodeHTML($order->order_id . rand(1000, 9999), 'C39') !!}
    </div>
    <div class="text">

        @foreach($order->orderTickets as $orderTicket)

            <h1>{{ $orderTicket->concertTicket->ticketType->concert->concert_name }}</h1>
            <p>Featured Artist: {{ $orderTicket->concertTicket->ticketType->concert->artist->name }}</p>
            <p>Venue: {{ $orderTicket->concertTicket->ticketType->concert->venue }}</p>
            <p>Concert Date: {{ $orderTicket->concertTicket->ticketType->concert->date }}</p>
            <p>Ticket Type: {{ $orderTicket->concertTicket->ticketType->type_name }}</p>
        @endforeach


        <p>Order Date: {{ $order->order_date }}</p>
            <p style="font-style: italic; font-weight: bold">1st Symphony Concert Ticket</p>
    </div>
</div>

</body>
</html>
