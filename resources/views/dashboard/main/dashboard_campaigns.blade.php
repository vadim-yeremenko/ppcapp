<div class="campaigns-list">
    <div class="campaigns-list_head filters-box">
        <div class="title">
            <span>Campaigns</span>
        </div>
        <div class="filter-param">
            <div class="filter-param_title">
                <span>during</span>
            </div>
            <div class="filter-param-date input-date-range">
                <input type="text" class="datepicker date-filter" data-url="{{route('ajax-filter')}}" data-action="campaigns_dashboard">
                <i class="icon-date"></i>
            </div>
        </div>
        <div class="more-filters">
            <a href="#" class="filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
            <div class="filters-popup">
                <form action="{{route('ajax-filter')}}" id="filter-popup-campaign" class="filter-form" data-action="campaigns_dashboard">
{{--                    <div class="filter-popup_row">--}}
{{--                        <div class="title">Product</div>--}}
{{--                        <select name="product" id="product" class="select-styled">--}}
{{--                            <option value="all">All products</option>--}}
{{--                            @foreach($campaigns_list as $campaign)--}}
{{--                                <option value="{{$campaign->id}}">{{$campaign->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="filter-popup_row">
                        <div class="filter-calendar">
                            <input type="text" name="date" class="date-picker-calendar" value="">
                        </div>
                    </div>
                    <div class="filter-popup_row">
                        <div class="title">Total spendings</div>
                        <div class="ranges range-double">
                            <input type="text" name="spendings" class="input-slider-range" data-min="{{$campaign_filter['min_spendings']}}" data-max="{{$campaign_filter['max_spendings']}}">
                        </div>
                    </div>
                    <div class="filter-popup_row">
                        <div class="title">Total clicks</div>
                        <div class="ranges range-double">
                            <input type="text" name="clicks" class="input-slider-range" data-min="{{$campaign_filter['min_clicks']}}" data-max="{{$campaign_filter['max_clicks']}}" data-step="1" data-prefix=" ">
                        </div>
                    </div>
                    <div class="filter-popup_row centered">
                        <input type="submit" class="btn btn-blue" value="Filter" id="filter_campaign">
                    </div>
                </form>
            </div><!--/.filters-popup-->
        </div><!--/.more-filters-->
    </div><!--/.campaigns-list_head-->
    <div class="campaigns-list_main" id="filter-body">
        <div class="filter-inner" id="ajax-result">
            @foreach($campaings as $campaign)
                @include('dashboard.main.partials.campaign_item')
            @endforeach
        </div>
    </div>
    @if(count($campaings) > 6)
        <div class="campaigns-list_footer margin-24px_top">
            <a href="{{route('campaign')}}" class="btn btn-bordered btn-icon"><i class="icon-arrow-down"></i> <span>Show more</span></a>
        </div>
    @endif
</div>