<div class="campaign-item">
    <div class="campaign-item_name">
        <span class="label">Name:</span>
        <span class="value">{{$campaign->title}}</span>
    </div>
    <div class="campaign-item_clicks">
        <span class="label">Clicks:</span>
        <span class="value"><i class="{{$campaign->clicks_icon()}}"></i><b>{{$campaign->get_clicks_count()}}</b></span>
    </div>
    <div class="campaign-item_spending">
        <span class="label">Spending:</span>
        <span class="value"><i class="{{$campaign->spendings_icon()}}"></i>$<b>{{$campaign->get_spendings_summ()}}</b></span>
    </div>
    <div class="campaign-item_details">
        <a href="{{route('campaign-details', $campaign->id)}}" class="details-btn"><span>Details</span> <i class="icon-running"></i></a>
    </div>
</div>