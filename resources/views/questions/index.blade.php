@extends('layouts.app')

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <div class="col-sm-12">
    @foreach($questions as $question)
    <article class="media content-section">
            @csrf
        @if($question->profpic)
        <a class="mr-2" href="{{ route('user-profile', $question->uid) }}"><img class="rounded-circle article-img" src="{{ $question->profpic }}"></a>
        @else()
            <a class="mr-2" href="{{ route('user-profile', $question->uid) }}"><img class="rounded-circle article-img" src="http://127.0.0.1:8000/uploads/default.jpg"></a>
        @endif
            <div class="media-body">
            <div class="article-metadata">

                <a class="mr-2" href="{{ route('user-profile', $question->uid) }}"><button type="submit" class="buttontext" style="font-family: 'Century Schoolbook L'; color: #1d68a7;"><span class="dot"></span>&nbsp;{{ $question->name }}</button></a>
                <small class="text-muted">Created: {{ $question->created_at }}</small>
            </div>
            <form method="post" action="{{url('/view-question')}}">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $question->qid }}">
                <h2><a class="article-title" href=""><button type="submit" class="buttontext">{{ $question->title }}</button></a></h2>
            </form>
            <p class="article-content">{{ $question->question }}</p>

            <div class="quiz-icons">
                <i class="fa fa-envelope-o"></i>
                <i class="fa fa-thumbs-up"></i>
            </div>

        </div>

    </article>
    @endforeach
    </div>
@endsection
