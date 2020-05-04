@extends('layouts.dashboard')

@section('content')
    <div class="mainbar-header dashboard-header  filters-box">
        <div class="filters-box">
            <div class="title">
                <span>All Campaigns</span>
            </div>
        </div><!--/.sidebar-header_l-->
    </div>

    <div class="mainbar-main">
        @include('dashboard.main.dashboard_bars')
    </div><!--/.mainbar-main-->
    <div class="calendar">
        <div class="calendar_prev"><a href="{{$prev_month}}"><i class="icon-arrow-left"></i></a></div>
        <div class="calendar_next"><a href="{{$next_month}}"><i class="icon-arrow-right"></i></a></div>
        <div class="calendar-week-days">
            <span>S</span>
            <span>M</span>
            <span>T</span>
            <span>W</span>
            <span>T</span>
            <span>F</span>
            <span>S</span>
        </div>
        <div class="calendar-month">
            {!!$calendar!!}
        </div>
    </div>
@endsection