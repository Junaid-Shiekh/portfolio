<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Mail\ThankYouMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Messages/Index', [
            'messages' => $messages
        ]);
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        if ($message->status !== 'read') {
            $message->update(['status' => 'read']);
            
            // Send Email
            Mail::to($message->email)->send(new ThankYouMessage($message));
        }

        return back()->with('success', 'Message marked as read and thank you email sent!');
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message deleted successfully!');
    }
}
