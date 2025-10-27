<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;


class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('created_at')->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(\App\Models\ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(\App\Models\ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Mensagem excluída com sucesso!');
    }

    public function markAsRead(\App\Models\ContactMessage $message)
    {
        $message->status = 'read';
        $message->read_at = now();
        $message->save();
        return back()->with('success', 'Mensagem marcada como lida.');
    }

    public function markAsReplied(\App\Models\ContactMessage $message)
    {
        $message->status = 'replied';
        $message->save();
        return back()->with('success', 'Mensagem marcada como respondida.');
    }
}
