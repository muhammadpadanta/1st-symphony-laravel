<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
// Login function
    public function login(LoginRequest $req)
    {
        $user = User::where('username', $req->input('username'))->first();

        if (! $user || ! Hash::check($req->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Check if the email is verified
        if ($user->email_verified_at === null) {
            return response()->json(['message' => 'Email is not verified'], 400);
        }

        $userName = $req->input('username') ?? 'unidentified-user';
        $token = $user->createToken($userName)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    // Logout Function
    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
        return [
            'message' => 'Token deleted'
        ];
    }

    // Me Function
    public function me(Request $req)
    {
        $user = Auth::User();
        $user->load('orders.userTicket', 'orders.orderTickets.concertTicket.ticketType');

        return response()->json($user);
    }


    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        // Handle file upload if a file is provided
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('userpfp');
            $validatedData['file_path'] = $filePath;
        }

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        $user = User::create($validatedData);

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

    // Verify email via token
    public function verify(Request $request)
    {
        $token = $request->get('token');

        // Find the user by the token
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            // Check if the email is already verified
            if ($user->email_verified_at !== null) {
                return response()->json(['message' => 'Email is already verified']);
            }

            // Verify the user
            $user->email_verified_at = now();
            $user->save();

            return response()->json(['message' => 'Email verified successfully']);
        } else {
            return response()->json(['message' => 'Invalid verification token'], 400);
        }
    }
}
