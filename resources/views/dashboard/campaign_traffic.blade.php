@extends('layouts.dashboard')

@section('content')
    <div class="mainbar-header dashboard-header dashboard-header-back">
{{--        <a href="{{route('campaign')}}">Campaign: <span>{{$campaign->title}}</span></a>--}}
    </div>

    <div class="mainbar-main margin-0px_top_m">

        <div class="flex-row flex-between flex-align-top margin-24px_top mobile-flex-column">

            @include('dashboard.traffic_source.traffic_source_table')
            @include('dashboard.campaign.campaign_details')

        </div><!--/.flex-row-->

    </div><!--/.mainbar-main-->

@endsection