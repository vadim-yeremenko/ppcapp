@foreach($daily_overview as $item)
    <div class="table-row">
        <div class="table-col">
            <span class="title">Date:</span>
            <span class="value">{{$item['date']}}</span>
        </div>
        <div class="table-col">
            <span class="title">Clicks:</span>
            <span class="value"><i class="{{$item['clicks_icon']}}"></i> <b>{{$item['clicks']}}</b></span>
        </div>
        <div class="table-col">
            <span class="title">Spending:</span>
            <span class="value"><i class="{{$item['spendings_icon']}}"></i> $<b>{{$item['spendings']}}</b></span>
        </div>
    </div>
@endforeach