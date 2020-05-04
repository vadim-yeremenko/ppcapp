@extends('layouts.dashboard')

@section('content')
    <div class="mainbar-header dashboard-header dashboard-header-back">
        <a href="{{route('campaign')}}">Campaign: <span>{{$campaign->title}}</span></a>
    </div>
    @include('dashboard.campaign.campaign_stats')
    <div class="mainbar-main">
        @include('dashboard.main.dashboard_bars')
        <div class="flex-row flex-between flex-align-top margin-24px_top mobile-campaign-row mobile-flex-column">
            @include('dashboard.campaign.daily_overview')
            @include('dashboard.campaign.traffic_source')
            @include('dashboard.campaign.campaign_details')
        </div><!--/.flex-row-->
    </div><!--/.mainbar-main-->
    @include('dashboard.campaign.campaign_disable_popup')
@endsection