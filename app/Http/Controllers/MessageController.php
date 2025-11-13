<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        // Legutóbbi üzenetek elöl, 20-as lapozással
        $messages = Message::orderByDesc('created_at')->paginate(20);

        return view('messages.index', compact('messages'));
    }
}
