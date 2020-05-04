@foreach($stats_week as $stats)
    @if($stats['spendings'] || $stats['spendings'])
        <div class="chart-bar-item" data-spending="{{$stats['spendings']}}" data-clicks="{{$stats['clicks']}}" data-date="{{$stats['date']}}">
            <div class="chart-bar-item_counter">
                <span>{{$stats['clicks']}}</span>
            </div>
            <div class="chart-bar-item_bar">
                <span>$<b>{{$stats['spendings']}}</b></span>
            </div>
            <div class="chart-bar-item_date">
                <span>{{$stats['date']}}</span>
            </div>
        </div><!--/.chart-bar-item-->
    @else
        <div class="chart-bar-item" data-spending="{{$stats['spendings']}}" data-clicks="{{$stats['clicks']}}" data-date="{{$stats['date']}}">
            <div class="chart-bar-item-na">
                <span>N/A</span>
            </div>
            <div class="chart-bar-item_date">
                <span>{{$stats['date']}}</span>
            </div>
        </div><!--/.chart-bar-item-->
    @endif
@endforeach