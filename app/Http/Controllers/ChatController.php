<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{

    public function messageSent(Request $request)
    {
        event(new MessageSent('Hello, this is a message sent event!', $request->user()->id));
        return response()->json(['status' => 'Message Sent!']);
    }
}
