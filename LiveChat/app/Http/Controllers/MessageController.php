<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send a message and broadcast it.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        // Get the message from the request
        Log::info('inside send()');
        \Log::info('Broadcasting message', ['message' => $request->message]);
        log::info($request);
        $message = $request->input('message');
        
        // Check if a user is authenticated or treat as a guest
        // $user = auth()->user() ?? (object)['name' => 'Guest'];  // Guest user if not authenticated

        // Broadcast the message to other users on the "chat" channel
        broadcast(new MessageSent($message))->toOthers(); 
        // broadcast(new MessageSent((object)['name' => $request->name], $request->message))->toOthers();


        // Return a response confirming that the message was sent
        return response()->json(['status' => 'Message Sent!']);
    }
}
