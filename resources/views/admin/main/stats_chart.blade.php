<div class="stats-chart">
    <div class="stats-chart_head filters-box">
        <div class="chart-filter">
            <form action="{{route('filter-stats')}}" id="filter-stats-form">
                <div class="chart-filter-params ">
                    {{--                            <div class="chart-filter_item filter-param">--}}
                    {{--                                <div class="filter-param_title">--}}
                    {{--                                    Show--}}
                    {{--                                </div>--}}
                    {{--                                <div class="filter-param_input">--}}
                    {{--                                    <select name="show" id="show" class="select-styled width-98px">--}}
                    {{--                                        <option value="Daily_CPC">Daily CPC</option>--}}
                    {{--                                        <option value="Monthly_CPC">Monthly CPC</option>--}}
                    {{--                                        <option value="Yearly_CPC">Yearly CPC</option>--}}
                    {{--                                    </select>--}}
                    {{--                                </div>--}}
                    {{--                            </div><!--/.chart-filter_item-->--}}
                    <div class="chart-filter_item filter-param">
                        <div class="filter-param_title">
                            for
                        </div>
                        <div class="filter-param_input">
                            <select name="campaign" id="campaign" class="select-styled width-134px">
                                <option value="all">All campaigns</option>
                                @foreach($campaigns_list as $campaign)
                                    <option value="{{$campaign->id}}">{{$campaign->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!--/.chart-filter_item-->
                    <div class="chart-filter_item filter-param">
                        <div class="filter-param_title">
                            <span>during</span>
                        </div>
                        <div class="filter-param-date input-date-range">
                            <input type="text" class="datepicker" id="filter-stats-date-range">
                            <i class="icon-date"></i>
                        </div>
                    </div><!--/.chart-filter_item-->
                </div>
            </form><!--/.form filter-->
        </div><!--/.chart-filter-->
        <div class="chart-hide">
            <a href="#" class="chart-hide-btn"><span>Hide stats</span> <i class="icon-arrow-up"></i></a>
        </div>
    </div><!--/.stats-chart_head-->
    <div class="stats-chart_body">
        <div class="chart-bar" data-min-value="{{$min_clicks_stats}}" data-max-value="{{$max_clicks_stats}}">
            <div class="chart-bar-lines"></div>
            <div class="chart-bar_vert"></div>
            <div class="chart-bar_wrapper">
                <div class="chart-bar_wrap" id="chart-bar">
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
                </div>
            </div>
        </div>
    </div><!--/.stats-chart_body-->
</div><!--/.stats-chart-->