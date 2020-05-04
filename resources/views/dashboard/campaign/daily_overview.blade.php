<div class="campaign-daily-table table table-padding-left">
    <div class="table-head">
        <div class="table-col">
            <span class="h4-like">Daily Overview</span>
        </div>
        <div class="table-col ta-right more-filters">
            <a href="#" class="filter-popup-open btn-filters"><span>Filters</span><i class="icon-filters"></i></a>
            <div class="filters-popup">
                <form action="{{route('ajax-filter', ['id' => request()->route('id')])}}" id="daily_overview" class="filter-form" data-action="daily_overview" data-result="daily_overview_result">
                    <input type="hidden" name="campaign_id" value="{{request()->route('id')}}">
                    <div class="filter-popup_row">
                        <div class="title">Spendings</div>
                        <div class="ranges range-double">
                            <input type="text" name="spending" class="input-slider-range" data-min="{{$daily_overview_values['min_spendings']}}" data-max="{{$daily_overview_values['max_spendings']}}" >
                        </div>
                    </div>
                    <div class="filter-popup_row">
                        <div class="title">Clicks</div>
                        <div class="ranges range-double">
                            <input type="text" name="click" class="input-slider-range" data-min="{{$daily_overview_values['min_clicks']}}" data-max="{{$daily_overview_values['max_clicks']}}" data-prefix=" " data-step="1">
                        </div>
                    </div>
                    <div class="filter-popup_row centered">
                        <input type="submit" class="btn btn-blue" value="Filter">
                    </div>
                </form>
            </div><!--/.filters-popup-->
        </div>
    </div>
    <div id="daily_overview_result">
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
    </div>
    @if($daily_overview_values['total_count'] > 6)
        <div class="table-footer table-footer-btn margin-24px_top">
            <a href="{{route('ajax-filter')}}" class="btn btn-bordered btn-icon" data-action="daily_overview" data-pagination="2" data-filter="daily_overview" data-result="daily_overview_result"><i class="icon-arrow-down"></i><span>Show more</span></a>
        </div>
    @endif
</div><!--/.campaign-daily-table-->