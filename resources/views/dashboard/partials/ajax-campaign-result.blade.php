@foreach($campaings as $campaign)
    <div class="campaign-item">
        <div class="campaign-item_name">
            <span class="label">Name:</span>
            <span class="value">{{$campaign->title}}</span>
        </div>
        <div class="campaign-item_clicks">
            <span class="label">Clicks:</span>
            <span class="value"><i class="icon-grow-up"></i> <b>511</b></span>
        </div>
        <div class="campaign-item_spending">
            <span class="label">Spending:</span>
            <span class="value"><i class="icon-grow-down"></i> $<b>514.32</b></span>
        </div>
        <div class="campaign-item_details">
            <a href="/dashboard/campaign/{{$campaign->id}}" class="details-btn"><span>Details</span> <i class="icon-running"></i></a>
        </div>
    </div>
@endforeach