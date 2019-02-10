<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        $user = User::find($user-> id);
        return view('users.index', ['user'=> $user]);
        */

        $user_id = $request->input('user_id');
        $users = DB::select("SELECT * FROM users WHERE id=$user_id");

        $questions = DB::table('users')
            ->join('questions', 'users.id', '=', 'questions.user_id')
            ->select('users.*', 'questions.*')->orderBy('questions.created_at', 'desc')
            ->paginate(5);
        return view('users.index', ['users'=> $users, 'questions'=> $questions]);

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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $users = DB::select("SELECT * FROM users WHERE id=$id");

        $questions = DB::table('users')
            ->join('questions', 'users.id', '=', 'questions.user_id')
            ->select('users.*', 'questions.*')->orderBy('questions.created_at', 'desc')
            ->paginate(5);
        return view('users.index', ['users'=> $users, 'questions'=> $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        $this->validate($request,[
            'prof_pic'=>'required |image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username'=>'required',
            'status'=>'required',

        ]);


        $username=$request->input('username');
        $status=$request->input('status');
        $website=$request->input('website');

        $prof_pic="/uploads"."/".$request->input('prof-pic');

        //uploading image to public/uploads  folder
        if(Input::hasFile('prof_pic')){
            $file= Input::file('prof_pic');
            $file->move(public_path().'/uploads', $file->getClientOriginalName());
            $url=URL::to("/") . '/uploads'.'/'. $file->getClientOriginalName();


            //getting user id
            $user_id=Auth::user()->id;
            //upating user table
            DB::update("UPDATE users SET name = ?, status = ? , profpic = ?, website = ? WHERE id = ?",[$username,$status,$url,$website,$user_id]);

        }




        return redirect('/home')->with('response','Profile updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
