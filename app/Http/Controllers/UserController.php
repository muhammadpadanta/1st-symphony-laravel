<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Concert;
use App\Models\ConcertTicket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

function listuser()
{
    return user::all();
}

    public function getAllArtists()
    {
        $artists = Artist::with('concerts', 'songs')->get();
        return response()->json($artists);
    }

    public function getArtistById($id)
    {
        $artist = Artist::with('concerts', 'songs')->find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        return response()->json($artist);
    }

    public function getAllConcerts()
    {
        $concerts = Concert::with(['artist', 'ticketTypes.concertTickets'])->get();

        return response()->json($concerts);
    }

    public function getAllTicketTypes()
    {
        $ticketTypes = TicketType::all();
        return response()->json($ticketTypes);
    }

    public function getAllConcertTickets()
    {
        $concertTickets = ConcertTicket::all();
        return response()->json($concertTickets);
    }

// Delete user based on user_id
function deleteuser($user_id)
{
    $result=User::where('user_id',$user_id)->delete();
    if($result){
        return["result"=>"User telah dihapus!"];
    }else{
        return["result"=>"User tidak ditemukan"];
    }

}

// Update user based on user_id



}
