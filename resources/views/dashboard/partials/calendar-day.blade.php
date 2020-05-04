<div class="calendar-day {{$class}}">
    <div class="calendar-day_date">{{$day}}</div>
    <div class="calendar-day_camp"><span><b>{{$campaigns}}</b> campaigns </span><a href="{{$campaigns_url}}"><i class="icon-arrow-det"></i></a></div>
    <div class="calendar-day_row">
        <span class="title">Spending:</span>
        <span class="value">$<b>{{$spendings}}</b></span>
        <span class="icon"><i class="{{$spendings_icon}}"></i></span>
    </div>
    <div class="calendar-day_row">
        <span class="title">Clicks:</span>
        <span class="value"><b>{{$clicks}}</b></span>
        <span class="icon"><i class="{{$clicks_icon}}"></i></span>
    </div>
</div>