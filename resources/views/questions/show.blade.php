@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

@section('content')
    @foreach($questions as $quiz)
        <article class="media content-section">
            <img class="rounded-circle article-img" src="{{ $quiz->profpic }}">
            <div class="media-body">
                <div class="article-metadata">
                    <a class="mr-2" href="">{{ $quiz->name }}</a>
                    <small class="text-muted">{{ $quiz->created_at }}</small>
                    <div class="">
                        @if(Auth::user()->id==($quiz->uid))
                        <a class="btn btn-secondary btn-sn mt-1 mb-1" href="" data-toggle="modal" data-target="#quizUpdate">Update</a>
                        <a class="btn btn-danger btn-sn mt-1 mb-1" href='delete-question/{{ $quiz->qid }}'>Delete</a>

                            <!-- Modal -->
                            <div id="quizUpdate" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-primary" style="padding-left: 21px;">Update Question</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="{{ url('/update-question') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="quiz_id" value="{{ $quiz->qid }}">
                                                <div class="form-group">
                                                    <label class="">Title:</label>
                                                    <input type="text" class="form-control col-md-6" name="title" value="{{ $quiz->title }}" required />
                                                </div>

                                                <div class="form-group">
                                                    <label class="">Question:</label>
                                                    <textarea rows="7" class="form-control" name="question" required >{{ $quiz->question }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @endif

                        <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm" style="float: right;">comment</a>
                    </div>
                </div>
                <h2 class="article-title">{{ $quiz->title }}</h2>
                <p class="article-content">{{ $quiz->question }}</p>


                <div class="article-metadata">
                    <br>
                    @if($comments)
                    <h5 class="text-secondary text-outline-primary">Comments:</h5>
                </div>
                @foreach($comments as $comment)
                <form method="post" action="{{url('/user-profile')}}">
                    @csrf
                <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                    <p style="margin-bottom: 1px; border-bottom: 1px;">{{ $comment->comment }} - <a class="mr-2" href=""><button type="submit" class="buttontext">{{ $comment->name }}</button></a></p>
                    <hr>
                </form>
                <div class="">

                </div>
                    @endforeach
                @endif


            </div>



            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <h4 class="modal-title text-primary" style="padding-left: 21px;">Comment</h4>
                        <div class="modal-body">
                            <form class="form-horizontal" action="{{ url('/add-comment') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->qid }}">
                                <div class="form-group">
                                    <textarea rows="7" class="form-control" name="comment" required ></textarea>
                                </div>

                                <div class="form-group" style="padding: 8px;">
                                    <button type="submit" class="btn btn-success">Comment</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>






        </article>
    @endforeach
@endsection
