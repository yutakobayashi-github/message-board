<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
class MessagesController extends Controller
{
   
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->paginate(25);

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    
    public function create()
    {
         $message = new Message;

        return view('messages.create', [
            'message' => $message,
        ]);
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'content' => 'required|max:191',
        ]);
        
        
        $message = new Message;
        $message->title = $request->title; 
        $message->content = $request->content;
        $message->save();

        return redirect('/');
    }

    
    public function show($id)
    {
        $message = Message::find($id);

        return view('messages.show', [
            'message' => $message,
        ]);
    }

    
    public function edit($id)
    {
        $message = Message::find($id);

        return view('messages.edit', [
            'message' => $message,
        ]);
    }

    
    public function update(Request $request, $id)
    
    {
         $this->validate($request, [
             'title' => 'required|max:191',
            'content' => 'required|max:191',
        ]);
        
        $message = Message::find($id);
        $message->title = $request->title; 
        $message->content = $request->content;
        $message->save();

        return redirect('/');
    }

    
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect('/');
    }
}
