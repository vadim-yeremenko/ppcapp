{{--@extends('layouts.dashboard')--}}

{{--@section('content')--}}

    <div class="title-underlined">
        <h2>Create new ad</h2>
    </div>
    <div class="successfully-box new_add_success">
        <div class="successfully-box_icon">
            <i class="icon-added-success"></i>
        </div>
        <span>Your new campaign has been created</span>
    </div>
    <div class="campaign-list">
        <div class="campaign" data-campaign="">
            <div class="campaign_title">
                <h3></h3>
            </div>
            <div class="campaign_table table">
                <div class="col_img">
                    <div class="image">
                        <img src="{{$campaign['img']}}" alt="{{$campaign['title']}}">
                    </div>
                </div>
                <div class="col_started">
                    <span class="title ta-left">Starting day:</span>
                    <span class="value"><b>{{$campaign['starting']}}</b></span>
                </div>
                <div class="col_bid">
                    <span class="title">Category:</span>
                    <span class="value"><b>{{$campaign['product']}}</b></span>
                </div>
                @if(!empty($campaign['subproduct']))
                    <div class="col_spending">
                        <span class="title">Sub category:</span>
                        <span class="value"><b>{{$campaign['subproduct']}}</b></span>
                    </div>
                @endif
                <div class="col_clicks">
                    <span class="title">CPC Bid:</span>
                    <span class="value">$<b>{{$campaign['cpc']}}</b></span>
                </div>
                <div class="col_url">
                    <span class="title">URL:</span>
                    <a href="{{$campaign['url_link']}}" class="url-btn" target="_blank"><span>{{$campaign['url']}}</span> <i class="icon-url"></i></a>
                </div>
            </div>
        </div><!--/campaign.-->
    </div><!--/.campaign-list-->
    <div class="campaigns-list_footer margin-24px_top">
        <a href="{{route('campaign')}}" class="btn btn-bordered"><span>View all campaigns</span></a>
    </div>
{{--@endsection--}}