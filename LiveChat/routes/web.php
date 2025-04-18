<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;


Route::get('/chat', function () {
    return view('chat');
});

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/chat', 'chat'); // Vue page route

Route::get('/messages', function () {
    return response()->json([
        ['name' => 'Alice', 'message' => 'Hello!'],
        ['name' => 'Bob', 'message' => 'Hey Alice!'],
    ]);
});

Route::post('/send-message', [MessageController::class, 'send']);











//     $message = request('message');
//     $user = auth()->user() ?? (object)['name' => 'Guest'];

//     // Optional: store messages in DB or cache later
//     broadcast(new MessageSent($user, $message))->toOthers();

//     return response()->json(['status' => 'Message Sent!']);
