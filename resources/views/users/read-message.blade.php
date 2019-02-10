@extends('layouts.app')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
@section('content')

    <div class="row1">

        <!-- code start -->

        <div class="twPc-div">
            <a class="twPc-bg twPc-block"></a>

            <div>

                @foreach($users as $user)
                    <a title="Mert S. Kaplan" href="https://twitter.com/mertskaplan" class="twPc-avatarLink">
                        @if(!empty($user->profpic))
                            <img alt="Mert S. Kaplan" src="{{ $user->profpic }}" class="twPc-avatarImg">
                        @else
                            <img alt="Mert S. Kaplan" src="http://127.0.0.1:8000/uploads/default.jpg" class="twPc-avatarImg">
                        @endif
                    </a>

                    <div class="twPc-divUser">
                        <div class="twPc-divName">
                            <a href="https://twitter.com/mertskaplan">{{ $user->name }}</a>
                        </div>
                        <span>
				<a href="https://twitter.com/mertskaplan"><span>{{ $user->email }}</span></a>
			</span>
                    </div>




                @endforeach

                <div class="twPc-divStats">
                    <ul class="twPc-Arrange">
                        <li class="twPc-ArrangeSizeFit">
                            <a href="https://twitter.com/mertskaplan" title="9.840 Tweet">
                                <span class="twPc-StatLabel twPc-block">Quiz</span>
                                <span class="twPc-StatValue">9.840</span>
                            </a>
                        </li>
                        <li class="twPc-ArrangeSizeFit">
                            <a href="https://twitter.com/mertskaplan/following" title="885 Following">
                                <span class="twPc-StatLabel twPc-block">Following</span>
                                <span class="twPc-StatValue">885</span>
                            </a>
                        </li>
                        <li class="twPc-ArrangeSizeFit">
                            <a href="https://twitter.com/mertskaplan/followers" title="1.810 Followers">
                                <span class="twPc-StatLabel twPc-block">Followers</span>
                                <span class="twPc-StatValue">1.810</span>
                            </a>
                        </li>


                    </ul>
                </div>

            </div>

        </div>
    </div>
    <!-- code end -->
    <section class="row">

        <div class="col-sm-2">
            <br>
            <i class="fa fa-user">&nbsp;{{ $user->name }}</i>
            <i class="fa fa-book">&nbsp;{{ $user->status }}</i>
            <a href="{{ $user->website }}"> <i class="fa fa-link">&nbsp;{{ $user->website }}</i></a>

            @if(Auth::user()->id==$user->id)
                <a href="" data-toggle="modal" data-target="#profileModal"><i class="fa fa-pencil">&nbsp;Update profile</i></a>
                <a href="{{ url('/view-messages') }}"><i class="fa fa-envelope">&nbsp; Messages</i></a> </p>
            @else
                <p class=""><a href="" data-toggle="modal" data-target="#myModal"> {{ $user->name }}</a> </p>
            @endif
        </div>

        <div class="col-sm-10">
            <br>


            <section id="">
                    <!-- page start-->
                    <tr class="row mt">
                        <div class="col-sm-12">
                            <section class="panel">
                                <td class="panel-body ">


                                        <div class="row">
                                            <div class="col-sm-12">
                                            <table class="table">
                                            @foreach($message as $sms)
                                                <tr>
                                                <form method="post" action="{{url('/user-profile')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $sms->user_id }}">
                                                    <td><a class="mr-2" href=""><button type="submit" class="buttontext">{{ $sms->name }}</button></a></td>
                                                </form>

                                    <td>
                                    <div class="view-mail">
                                        <p>{{ $sms->message }}</p>

                                    </div>
                                    </td>

                                    <td>
                                        <div class="col-md-4">
                                            <p class="date">{{ $sms->created_at }}</p>
                                        </div>
                                    </td>

                                    <td>
                                    <div class="compose-btn pull-left">
                                        <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-theme"><i class="fa fa-reply"></i> Reply</a>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="compose-btn pull-right" style="float: right;">
                                    <button class="btn btn-sm tooltips" data-original-title="Trash" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-trash-o"></i></button>

                                    </div>
                                </td>
                                        </tr>
                                    </table>
                                            </div>



                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-primary" style="padding-left: 21px;">Reply</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal" action="{{ url('/send-message') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="recepient_id" value="{{ $sms->user_id }}">
                                            <div class="form-group">
                                                <textarea rows="7" class="form-control" name="message" required ></textarea>
                                            </div>

                                            <div class="form-group" style="padding: 8px;">
                                                <button type="submit" class="btn btn-success">Send</button>
                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>


                        @endforeach
                                        </div>

                            </section>

                <!-- /wrapper -->

@endsection

