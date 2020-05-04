<div class="campaign-traffic-source-big table">
    <div class="table-head">
        <div class="table-col">
            <span class="h4-like">Traffic source</span>
        </div>
        <div class="table-col ta-right more-filters">
            <a href="#" class="filter-popup-open btn-filters"><span>Filters</span><i class="icon-filters"></i></a>
            <div class="filters-popup">
                <form action="{{route('ajax-filter', ['id' => request()->route('id')])}}" id="campaigns_traffic" class="filter-form" data-action="traffic_source_page">
                    <input type="hidden" name="campaign_id" value="{{request()->route('id')}}">
                    <div class="filter-popup_row">
                        <div class="title">Clicks</div>
                        <div class="ranges range-double">
                            <input type="text" name="click" class="range-integer" data-min="{{$traffic_filter_values['min_clicks']}}" data-max="{{$traffic_filter_values['max_clicks']}}" data-current="{{$traffic_filter_values['min_clicks']}}" data-prefix="" data-step="1">
                        </div>
                    </div>
                    <div class="filter-popup_row">
                        <div class="title">Spendings</div>
                        <div class="ranges range-double">
                            <input type="text" name="spending" class="range-integer" data-min="{{$traffic_filter_values['min_spendings']}}" data-max="{{$traffic_filter_values['max_spendings']}}" data-current="{{$traffic_filter_values['min_spendings']}}" data-prefix="" data-step="1">
                        </div>
                    </div>
                    <div class="filter-popup_row centered">
                        <input type="submit" class="btn btn-blue" value="Filter">
                    </div>
                </form>
            </div><!--/.filters-popup-->
        </div>
    </div>
    <div id="ajax-result">
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
    </div>
    @if($traffic_filter_values['total_count'] > 6)
        <div class="table-footer table-footer-btn margin-24px_top">
            <a href="{{route('ajax-filter')}}" class="btn btn-bordered btn-icon" data-action="traffic_source_page" data-pagination="2" data-filter="campaigns_traffic"><i class="icon-arrow-down"></i><span>Show more</span></a>
        </div>
    @endif
</div><!--/.campaign-traffic-source-->