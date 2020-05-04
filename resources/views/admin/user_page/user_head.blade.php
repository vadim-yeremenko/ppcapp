<div class="mainbar-header dashboard-header dashboard-header-back">
    <a href="{{route('admin-users')}}">User: <span>{{ $user->name }}</span></a>
</div>
<div class="mainbar-header dashboard-header user-stats-details user-info-box">
    <div class="dashboard-header_l">
        <div class="user-info">
            <div class="avatar">
                @if(isset($user->avatar))
                    <div class="img">
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                    </div>
                @else
                    <div class="img">
                        <img src="{{url('img/avatar-placeholder.png')}}" alt="{{ $user->name }}">
                    </div>
                @endif
            </div>
        </div>
        <div class="user-info">
            <div class="title">User:</div>
            <div class="value"><b>{{ $user->name }}</b></div>
        </div><!--/.user-info-->
        <div class="user-info">
            <div class="title">Role in organization:</div>
            <div class="value"><b>{{ $user->role }}&nbsp;</b></div>
        </div><!--/.user-info-->
        <div class="user-info">
            <div class="title">Email address:</div>
            <div class="value"><a href="mailto:{{ $user->email }}" title="{{ $user->email }}"><b>@php echo mb_strimwidth($user->email, 0, 20, "...") @endphp</b></a></div>
        </div><!--/.user-info-->
    </div><!--/.sidebar-header_l-->
    <div class="dashboard-header_r">
        <a href="mailto:{{ $user->email }}" class="btn btn-blue btn-icon"><i class="icon-email"></i><span>Send Message</span></a>
        <a href="#" class="btn btn-bordered margin-24px_left" data-user="{{ $user->id }}" id="suspend-user"><span>Suspend account</span></a>
    </div>
</div><!--/.user-info-box-->