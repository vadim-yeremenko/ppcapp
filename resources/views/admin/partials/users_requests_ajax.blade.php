@foreach($users_list as $user)
    <div class="table-row table-row-requests" data-user="{{$user['id']}}">
        <div class="col">
            <div class="user-avatar">
                <div class="img">
                    @if(empty($user['avatar']))
                        <div class="user-avatar">
                            <img src="../img/avatar-placeholder.png" alt="{{$user['name']}}">
                        </div>
                    @else
                        <div class="user-avatar">
                            <img src="{{$user['avatar']}}" alt="{{$user['name']}}">
                        </div>
                    @endif
                </div>
                {{--<span class="icon-suspended"></span>--}}
            </div>
        </div>
        <div class="col">
            <div class="title"><b>{{$user['name']}}</b></div>
            @if(!$user['organization'])
                <div class="value"><b>&nbsp;</b></div>
            @else
                <div class="value"><b>{{$user['organization']}}</b></div>
            @endif
        </div>

        <div class="col">
            <div class="title">Role in organization:</div>
            @if(!$user['role'])
                <div class="value"><b>&nbsp;</b></div>
            @else
                <div class="value"><b>{{$user['role']}}</b></div>
            @endif

        </div>
        <div class="col">
            <div class="title">Email address:</div>
            <div class="value"><a href="mailto:{{$user['email']}}" title="{{$user['email']}}">{{$user['email_truncated']}}</a></div>
        </div>
        <div class="col">
            <a href="#" data-action="{{route('admin-users-request-accept')}}" class="accept-btn accept-user-btn" data-user="{{$user['id']}}"><span>Accept</span> <i class="icon-accept"></i></a>
            <a href="#decline-user-popup" class="decline-btn decline-user-btn" data-action="{{route('admin-users-request-accept')}}" data-user="{{$user['id']}}"><span>Decline</span> <i class="icon-decline"></i></a>
        </div>
    </div><!--/.table-row-requests-->
@endforeach
