{{--@extends('layouts.dashboard')--}}

{{--@section('content')--}}

    <div class="title-underlined padding-16px_left">
        <h2>Campaign disabled</h2>
    </div>
    <div class="successfully-box new_add_success">
        <div class="successfully-box_icon">
            <i class="icon-disabled-success"></i>
        </div>
        <span>Your campaign called {{$campaign->title}} has been disabled.</span>
    </div>
    <div class="campaign-list">
        <div class="campaign">
            <div class="campaign_title">
                <h3>{{$campaign->title}}</h3>
            </div>
            <div class="campaign_table table">
                <div class="col_img">
                    <div class="image">
                        <img src="{{$campaign->image}}" alt="{{$campaign->image}}">
                    </div>
                </div>
                <div class="col_started_day">
                    <span class="title">Starting day:</span>
                    <span class="value"><b>{{$campaign->modified_day_date()}}</b></span>
                </div>
                <div class="col_total_clicks">
                    <span class="title">Total clicks:</span>
                    <span class="value"><b>{{$campaign->get_clicks_count()}}</b></span>
                </div>
                <div class="col_total_spending">
                    <span class="title">Total spending:</span>
                    <span class="value">$<b>{{$campaign->spendings_summ()}}</b></span>
                </div>
                <div class="col_cpc">
                    <span class="title">Av. CPC Bid:</span>
                    <span class="value"><b>{{$campaign->cpc}}</b></span>
                </div>
            </div>
        </div><!--/campaign.-->
    </div><!--/.campaign-list-->
    <div class="campaigns-list_footer margin-24px_top">
        <a href="{{route('campaign')}}" class="btn btn-bordered"><span>View all campaigns</span></a>
        <a href="{{route('add-campaign')}}" class="btn btn-blue btn-icon margin-24px_left"><i class="icon-plus"></i><span>Create new ad</span></a>
    </div>
{{--@endsection--}}