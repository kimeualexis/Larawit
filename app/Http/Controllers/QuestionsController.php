<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*
        $questions = Question::with('users')->get();
        return view('questions.index', ['questions'=> $questions]);
        */
        $questions = DB::table('users')
            ->join('questions', 'users.id', '=', 'questions.user_id')
            ->select('users.*', 'questions.*')->orderBy('questions.created_at', 'desc')
            ->paginate(5);


        return view('questions.index', ['questions'=> $questions]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $user_id = $request->input('user_id');
        $title = $request->input('title');
        $question = $request->input('question');
        $created_at = date('Y-m-d H:i:s');

        DB::table('questions')->insert([[
            'user_id'=>$user_id,
            'title'=>$title,
            'question'=>$question,
            'created_at'=>$created_at


        ]]);

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
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
     /*
     $question = Question::find($question-> id);
     return view('questions.show', ['question'=> $question]);
     */

        //$question = DB::select("SELECT * FROM questions WHERE id=$quiz");
        $quiz = $request->input('quiz_id');
        $questions = DB::table('questions')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->where('questions.id', '=', $quiz)->get();
        $comments = DB::select("SELECT * FROM comments WHERE question_id=$quiz");
        return view('questions.show', ['questions'=> $questions], ['comments'=> $comments]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
        /*
        $question = Question::find($question->id);
        return view('', ['question'=>$question]);
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        $quiz_id = $request->input('quiz_id');
        $title = $request->input('title');
        $question = $request->input('question');

        DB::update("UPDATE questions set title = ?, question = ? WHERE id = ?",[$title,$question,$quiz_id]);
        return view('home');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, $id)
    {

        $quiz = Question::find($id);
        $quiz->destroy();
        //
    }
}
