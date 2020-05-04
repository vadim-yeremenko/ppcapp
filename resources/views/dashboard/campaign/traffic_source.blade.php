<div class="campaign-traffic-source table">
    <div class="table-head">
        <div class="table-col">
            <span class="h4-like">Traffic source</span>
        </div>
        <div class="table-col ta-right more-filters">
            <a href="#" class="filter-popup-open btn-filters"><span>Filters</span><i class="icon-filters"></i></a>
            <div class="filters-popup">
                <form action="{{route('ajax-filter', ['id' => request()->route('id')])}}" id="campaigns_traffic" class="filter-form" data-action="traffic_source">
                    <input type="hidden" name="campaign_id" value="{{request()->route('id')}}">
                    <div class="filter-popup_row">
                        <div class="title">Clicks</div>
                         <div class="ranges range-double">
                            <input type="text" name="click" class="range-integer" data-min="{{$traffic_filter_values['min_clicks']}}" data-max="{{$traffic_filter_values['max_clicks']}}" data-current="{{$traffic_filter_values['min_clicks']}}" data-prefix="" data-step="1">
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
                    <span class="value">{{$traffic['count']}}</span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="table-footer table-footer-btn margin-24px_top">
        <a href="{{route('campaigns_traffic', ['id' => request()->route('id')])}}" class="btn btn-bordered" ><span>view all traffic</span></a>
    </div>
</div><!--/.campaign-traffic-source-->