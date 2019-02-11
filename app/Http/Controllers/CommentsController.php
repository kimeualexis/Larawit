<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $quiz = $request->input('quiz_id');
        $comment = $request->input('comment');
        $name = Auth::user()->name;
        $user_id = Auth::user()->id;

        DB::table('comments')->insert([[
            'name'=>$name,
            'comment'=>$comment,
            'user_id'=>$user_id,
            'question_id'=>$quiz,

        ]]);

        //return redirect('/view-question')
        $questions = DB::table('questions')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->where('questions.id', '=', $quiz)
            ->select('users.id as uid', 'users.profpic as profpic', 'users.name as name', 'questions.id as qid', 'questions.title as title', 'questions.question as question', 'questions.created_at as created_at')->get();
        $comments = DB::select("SELECT * FROM comments WHERE question_id=$quiz");
        return view('questions.show', ['questions'=> $questions], ['comments'=> $comments]);



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
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
