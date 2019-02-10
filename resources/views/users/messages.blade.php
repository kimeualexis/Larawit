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
    <div class="row">

        <div class="col-sm-2">
            <br>
            <i class="fa fa-user">&nbsp;{{ $user->name }}</i>
            <i class="fa fa-book">&nbsp;{{ $user->status }}</i>
            <a href="{{ $user->website }}"> <i class="fa fa-link">&nbsp;{{ $user->website }}</i></a>

            @if(Auth::id()==$user->id)
                <a href="" data-toggle="modal" data-target="#profileModal"><i class="fa fa-pencil">&nbsp;Update profile</i></a><br>
                <a href="{{ url('/view-messages') }}"><i class="fa fa-envelope">&nbsp; Messages</i></a>

                </div>
            @else
                <a href="" data-toggle="modal" data-target="#myModal">Message {{ $user->name }}</a>
            @endif


        <div class="col-sm-6">
            <br>

            <article class="media content-section">

                <div class="media-body">
                    <div class="article">

                        <form method="post" action="">
                            @csrf
                            <input type="hidden" name="user_id" value="">
                        </form>

                    </div>

                    <table class="table table-hover">
                        <h3 class="text-primary text-center">Messages</h3>

                        <tr><thead><th>Select</th><th>Sender</th><th>Message</th><th>Date</th></thead></tr>
                    @foreach($messages as $message)
                        @if(empty($message->status))
                    <tr class="unread">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="view-message"><a href='user-profile/{{ $message->user_id }}'>{{ $message->name }}</a></td>

                        <td class="view-message "><a href='read-message/{{ $message->id }}'>{{ $message->message }}</a></td>
                        <td class="view-message">{{ $message->created_at }}</td>
                    </tr>
                        @else
                    <tr class="read">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="view-message "><a href="">{{ $message->name }}</a></td>
                        <td class="view-message "><a href='read-message/{{ $message->id }}'>{{ $message->message }}</a></td>
                        <td class="view-message">{{ $message->created_at }}</td>
                    </tr>
                        @endif
                     @endforeach
                    </table>

                </div>

            </article>



        </div>

        <!-- Modal -->
        <div id="profileModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary">Update Profile</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{ url('/profile-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- <input type="hidden" name="_method" value="PUT">-->

                            <div class="form-group" style="padding: 8px;">
                                <label class="control-label">Profile pic</label>
                                <input type="file"  name="prof_pic" value="{{ Auth::user()->profpic }}" required />
                            </div>


                            <div class="form-group" style="padding: 8px;">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ Auth::user()->name }}" required />
                            </div>

                            <div class="form-group" style="padding: 8px;">
                                <label class="control-label">Status</label>
                                <textarea rows="5" class="form-control" name="status" required > {{ Auth::user()->status }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Website</label>
                                <input type="text" class="form-control" name="website" value="{{ Auth::user()->website }}">
                            </div>

                            <div class="form-group" style="padding: 8px;">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>




@endsection









