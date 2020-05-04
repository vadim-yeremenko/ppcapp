@foreach($users_list as $user)
    <div class="table-row table-row-users">
        <div class="col">
            <div class="user-avatar">
                <img src="{{$user->avatar}}" alt="{{$user->name}}">
            </div>
        </div>
        <div class="col">
            <div class="title"><b>{{$user->name}}</b></div>
            <div class="value">{{$user->organization}}</div>
        </div>
        <div class="col">
            <div class="title">Campaigns:</div>
            @if($user->campaigns_count == 1)
                <div class="value"><b>{{$user->campaigns_count}} campaign</b></div>
            @else
                <div class="value"><b>{{$user->campaigns_count}} campaigns</b></div>
            @endif
        </div>
        <div class="col">
            <div class="title">Last week’s spendings:</div>
            <div class="value">$<b>{{$user->spendings_last_week}}</b></div>
        </div>
        <div class="col">
            <div class="title">Total spendings:</div>
            <div class="value">$<b>{{$user->spendings_total}}</b></div>
        </div>
        <div class="col">
            <div class="title">Current balance:</div>
            <div class="value">$<b>{{$user->balance}}</b></div>
        </div>
        <div class="col">
            <a href="admin/users/{{$user->id}}" class="details-btn"><span>Details</span> <i class="icon-arrow-right-c"></i></a>
        </div>
    </div><!--/.table-row-->
@endforeach

<div class="table-footer-btn">
    <a href="{{route('admin-users')}}" class="btn btn-bordered" id="filter_users_dashboard"><span>View All</span></a>
</div>