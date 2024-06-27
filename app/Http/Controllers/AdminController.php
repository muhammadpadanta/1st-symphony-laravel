<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Concert;
use App\Models\User;
use App\Models\Song;
use App\Models\ConcertTicket;
use App\Models\TicketType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json(['message' => 'Welcome to the admin dashboard']);
    }


    public function getAllUsers()
    {
        $users = User::all();
        $users->load('orders.orderTickets.concertTicket.ticketType');
        return response()->json($users);
    }

    // CRUD ARTISTS
    public function createArtist(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'genre' => 'nullable|string|max:50',
            'photo' => 'nullable|file',
        ]);

        $data = [];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('artistphoto');
            $data['photo'] = $path;
        }

        $artist = Artist::create(array_merge($request->all(), $data));

        return response()->json([
            'message' => 'Artist registered successfully',
            'user' => $artist,
        ], 201);
    }

    public function getAllArtists()
    {
        $users = Artist::all();
        return response()->json($users);
    }

    public function getArtist($id)
    {
        $artist = Artist::findOrFail($id);

        return response()->json($artist);
    }

    public function updateArtist(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:100',
            'bio' => 'nullable|string',
            'genre' => 'nullable|string|max:50',
            'photo' => 'nullable|file',
        ]);

        $data = [];

        if ($request->has('photo')) {
            if ($request->file('photo')) {

                $path = $request->file('photo')->store('artistphoto');
                $data['photo'] = $path;
            } else {

                $data['photo'] = $request->input('photo');
            }
        }

        $artist = Artist::findOrFail($id);
        $artist->update(array_merge($request->all(), $data));

        return response()->json(['message' => 'Artist with ID ' . $id . ' successfully updated']);
    }

    public function deleteArtist($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();

        return response()->json(['message' => 'Artist with id ' . $id . ' successfully deleted'], 200);
    }
    // CRUD ARTISTS

    // CRUD CONCERTS
    public function createConcert(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|integer|exists:artists,artist_id',
            'concert_name' => 'required|string|max:100',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'description' => 'nullable|string',
            'concert_photo' => 'nullable|file',
        ]);

        $data = [];

        if ($request->hasFile('concert_photo')) {
            $path = $request->file('concert_photo')->store('concertphoto');
            $data['concert_photo'] = $path;
        }

        $concert = Concert::create(array_merge($request->all(), $data));

        return response()->json([
            'message' => 'Concert registered successfully',
            'concert' => $concert
        ], 201);
    }

    public function getAllConcerts()
    {
        $concerts = Concert::with(['artist', 'ticketTypes.concertTickets'])->get();

        return response()->json($concerts);
    }

    public function getConcert($id)
    {
        $concert = Concert::with(['artist', 'ticketTypes.concertTickets'])->findOrFail($id);

        return response()->json($concert);
    }

    public function updateConcert(Request $request, $id)
    {
        $request->validate([
            'artist_id' => 'integer|exists:artists,artist_id',
            'concert_name' => 'string|max:100',
            'date' => 'date',
            'venue' => 'string|max:255',
            'description' => 'nullable|string',
            'concert_photo' => 'nullable|file',
        ]);

        $data = [];

        if ($request->hasFile('concert_photo')) {
            $path = $request->file('concert_photo')->store('concertphoto');
            $data['concert_photo'] = $path;
        }

        $concert = Concert::findOrFail($id);
        $concert->update(array_merge($request->all(), $data));

        return response()->json(['message' => 'Concert with ID ' . $id . ' successfully updated']);
    }

    public function deleteConcert($id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();

        return response()->json(['message' => 'Concert with id ' . $id . ' successfully deleted'], 200);
    }
    // CRUD CONCERTS

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8',
            'gender' => 'required|string|max:255',
            'birth' => 'required|date',
            'phone' => 'required|integer',
            'address' => 'required|string|max:255',
            'pfp_path' => 'nullable|file',
            'role' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request['password']);

        if ($request->hasFile('pfp_path')) {
            $path = $request->file('pfp_path')->store('userpfps');
            $data['pfp_path'] = $path;
        }

        $user = User::create($data);

        // Generate a verification token
        $token = bin2hex(random_bytes(30));

        // Store the token in your database...
        $user->verification_token = $token;
        $user->save();

        // Send the email with the token
        Mail::to($user->email)->send(new VerificationEmail($token));

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:50',
            'username' => 'string|max:255|unique:users,username,'.$id.',user_id',
            'email' => 'string|email|max:50|unique:users,email,'.$id.',user_id',
            'password' => 'string|min:8',
            'gender' => 'string|max:255',
            'birth' => 'date',
            'phone' => 'integer',
            'address' => 'string|max:255',
            'role' => 'string|max:255',
        ]);

        $data = $request->except(['password', 'pfp_path']);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        if ($request->has('pfp_path')) {
            if ($request->file('pfp_path')) {
                // Handle file upload
                $path = $request->file('pfp_path')->store('userpfps');
                $data['pfp_path'] = $path;
            } else {
                // Handle JSON data
                $data['pfp_path'] = $request->input('pfp_path');
            }
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return response()->json(['message' => 'User with ID ' . $id . ' successfully updated']);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User with id ' . $id . ' successfully deleted'], 200);
    }
    // CRUD USERS

    // CRUD TICKETS_TYPES
    public function createTicketType(Request $request)
    {
        $request->validate([
            'concert_id' => 'required|integer|exists:concerts,concert_id',
            'type_name' => 'required|string|max:50',
            'price' => 'required|numeric|between:0,999999.99',
        ]);

        $ticketType = TicketType::create($request->all());
        $name = $ticketType->type_name;

        return response()->json(['message' => 'Successfully created New Ticket type Called ' . $name], 200);
    }

    public function getTicketType($id)
    {
        $ticketType = TicketType::findOrFail($id);

        return response()->json($ticketType);
    }

    public function updateTicketType(Request $request, $id)
    {
        $request->validate([
            'concert_id' => 'required|integer|exists:concerts,concert_id',
            'type_name' => 'required|string|max:50',
            'price' => 'required|numeric|between:0,999999.99',
        ]);

        $ticketType = TicketType::findOrFail($id);
        $ticketType->update($request->all());

        return response()->json($ticketType);
    }

    public function deleteTicketType($id)
    {
        $ticketType = TicketType::findOrFail($id);
        $ticketType->delete();

        return response()->json(['message' => 'Ticket type with id ' . $id . ' successfully deleted'], 200);
    }

    public function getAllTicketTypes()
    {
        $ticketTypes = TicketType::all();
        return response()->json($ticketTypes);
    }
    // CRUD TICKETS_TYPES

    // CRUD CONCERT_TICKETS
    public function createConcertTicket(Request $request)
    {
        $request->validate([
            'ticket_type_id' => 'required|integer|exists:ticket_types,ticket_type_id',
            'total_stock' => 'required|integer',
            'sold_tickets' => 'integer',
        ]);

        $concertTicket = ConcertTicket::create($request->all());
        $id = $concertTicket->ticket_type_id;
        return response()->json(['message' => 'Successfully created New Concert Ticket with ID ' . $id], 200);
    }

    public function getConcertTicket($id)
    {
        $concertTicket = ConcertTicket::findOrFail($id);

        return response()->json($concertTicket);
    }

    public function updateConcertTicket(Request $request, $id)
    {
        $request->validate([
            'ticket_type_id' => 'required|integer|exists:ticket_types,ticket_type_id',
            'total_stock' => 'required|integer',
            'sold_tickets' => 'integer',
        ]);

        $concertTicket = ConcertTicket::findOrFail($id);
        $concertTicket->update($request->all());

        return response()->json($concertTicket);
    }

    public function deleteConcertTicket($id)
    {
        $concertTicket = ConcertTicket::findOrFail($id);
        $concertTicket->delete();

        return response()->json(['message' => 'Concert ticket with id ' . $id . ' successfully deleted'], 200);
    }

    public function getAllConcertTickets()
    {
        $concertTickets = ConcertTicket::all();
        return response()->json($concertTickets);
    }
    // CRUD CONCERT_TICKETS

    // CRUD ORDERS
    public function getAllOrders()
    {
        $orders = Order::with('orderTickets.concertTicket.ticketType.concert')->get();

        return response()->json(['orders' => $orders], 200);
    }

    // CRUD ORDERS

    // CRUD SONGS
    public function createSong(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|integer|exists:artists,artist_id',
            'title' => 'required|string|max:255',
            'link_id' => 'required|string|max:255',
        ]);

        $song = Song::create($request->all());

        return response()->json([
            'message' => 'Song created successfully',
            'song' => $song,
        ], 201);
    }

    public function deleteSong($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return response()->json(['message' => 'Song with id ' . $id . ' successfully deleted'], 200);
    }

    public function getAllSongs()
    {
        $songs = Song::with('artist')->get();
        return response()->json($songs);
    }


    public function updateSong(Request $request, $id)
    {
        $request->validate([
            'artist_id' => 'integer|exists:artists,artist_id',
            'title' => 'string|max:255',
            'link_id' => 'string|max:255',
        ]);

        $song = Song::findOrFail($id);
        $song->update($request->all());

        return response()->json([
            'message' => 'Song updated successfully',
            'song' => $song,
        ], 200);
    }
// CRUD SONGS

}
