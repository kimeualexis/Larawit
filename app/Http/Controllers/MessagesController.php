<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $name = Auth::user()->name;
        $user_id = Auth::user()->id;
        $message = $request->input('message');
        $recipient_id = $request->input('recepient_id');
        $created_at = date('Y-m-d H:i:s');

        DB::table('messages')->insert([[
            'name'=>$name,
            'message'=>$message,
            'user_id'=>$user_id,
            'recipient_id'=>$recipient_id,
            'created_at'=>$created_at

        ]]);
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
        $user_id = Auth::user()->id;
        $users = DB::select("SELECT * FROM users WHERE id=$user_id");
        $messages = DB::select("SELECT * FROM messages WHERE recipient_id=$user_id ORDER BY created_at DESC");
        return view('users.messages', ['messages'=> $messages, 'users'=> $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function read($id){

        $message = DB::select("SELECT * FROM messages WHERE id=$id");
        DB::update("UPDATE messages SET status=? WHERE id=?", [1, $id]);

        $users = DB::select("SELECT recipient_id FROM messages WHERE id=$id");
        foreach($users as $user){
        $recipient_id = $user->recipient_id;
        }
        $users = DB::select("SELECT * FROM users WHERE id=$recipient_id");
        return view('users.read-message', ['message'=> $message, 'users'=>$users]);
    }


}
