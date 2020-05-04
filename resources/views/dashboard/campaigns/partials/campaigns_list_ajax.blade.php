@foreach($campaigns as $campaign)
    <div class="campaign" data-id="{{$campaign->id}}">
        <div class="campaign_title">
            <h3>{{$campaign->title}}</h3>
        </div>
        <div class="campaign_table table">
            <div class="col_img">
                <div class="image">
                    <img src="{{$campaign->image}}">
                </div>
            </div>
            <div class="col_started">
                <span class="title">Started on:</span>
                <span class="value"><b>{{$campaign->modified_date()}}</b></span>
            </div>
            <div class="col_bid">
                <span class="title">CPC Bid:</span>
                <span class="value"><i class="icon-grow-down"></i>$<b>{{$campaign->cpc}}</b></span>
            </div>
            <div class="col_spending">
                <span class="title">Spending:</span>
                <span class="value"><i class="icon-grow-up"></i>$<b>{{$campaign->spendings_summ()}}</b></span>
            </div>
            <div class="col_clicks">
                <span class="title">Clicks:</span>
                <span class="value"><b>{{$campaign->get_clicks_count()}}</b></span>
            </div>
            <div class="col_btns">
                <a href="{{route('campaign-details', ['id' => $campaign->id])}}" class="details-btn"><span>Details</span> <i class="icon-running"></i></a>
                <a href="#disable-campaign" data-fancybox class="deactivate-btn deactivate-campaign" data-campaign="{{$campaign->id}}" data-title="{{$campaign->title}}"><span>Deactivate campaign</span> <i class="icon-cross"></i></a>
            </div>
        </div>
    </div><!--/campaign.-->
@endforeach