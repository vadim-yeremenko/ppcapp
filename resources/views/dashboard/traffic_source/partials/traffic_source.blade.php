@foreach($traffic_source as $traffic)
    <div class="table-row">
        <div class="table-col">
            <span class="title">URL:</span>
            <span class="value">
                 <a href="{{$traffic['url']}}" class="url-btn"><span>{{$traffic['url_trim']}}</span> <i class="icon-url"></i></a>
            </span>
        </div>
        <div class="table-col">
            <span class="title">Clicks:</span>
            <span class="value"><b>{{$traffic['count']}}</b></span>
        </div>
        <div class="table-col">
            <span class="title">Spending:</span>
            <span class="value"><b>${{$traffic['spendings']}}</b></span>
        </div>
    </div>
@endforeach