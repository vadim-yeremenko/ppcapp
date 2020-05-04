@extends('layouts.admin')

@section('content')
    @include('admin.user_page.user_head')
    <div class="stats-chart margin-32px_top">
        <div class="stats-chart_head filters-box">
            <div class="chart-filter">
                <form action="{{route('filter-stats')}}" id="filter-stats-form">
                    <div class="chart-filter-params ">
                        <div class="chart-filter_item filter-param">
                            <div class="filter-param_title">
                                Show
                            </div>
                            <div class="filter-param_input">
                                <select name="show" id="show" class="select-styled width-98px">
                                    <option value="Daily_CPC">Daily CPC</option>
                                    <option value="Monthly_CPC">Monthly CPC</option>
                                    <option value="Yearly_CPC">Yearly CPC</option>
                                </select>
                            </div>
                        </div><!--/.chart-filter_item-->
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
    <div class="user-stats-box  margin-32px_top">
        <div class="user-stats-box_l">
            <div class="user-campaigns">
                <div class="users-campaign-table table">
                    <div class="table-head filters-box">
                        <div class="table-col">
                            <span class="h4-like">Campaigns</span>
                        </div>
                        <div class="chart-filter">
                            <form action="#">
                                <div class="chart-filter-params ">
                                    <div class="chart-filter_item filter-param">
                                        <div class="filter-param_title">
                                            <span>during</span>
                                        </div>
                                        <div class="filter-param-date input-date-range">
                                            <input type="text" class="datepicker">
                                            <i class="icon-date"></i>
                                        </div>
                                    </div><!--/.chart-filter_item-->
                                </div>
                            </form><!--/.form filter-->
                        </div><!--/.chart-filter-->
                        <div class="table-col ta-right more-filters">
                            <a href="#" class="filter-popup-open btn-filters"><span>Filters</span><i class="icon-filters"></i></a>
                            <div class="filters-popup">
                                <form action="#">
                                    <div class="filter-popup_row">
                                        <div class="title">Name</div>
                                        <select name="name" id="name" class="select-styled">
                                            <option value="name_4">4 items selected</option>
                                            <option value="name_3">3 items selected</option>
                                            <option value="name_2">2 items selected</option>
                                            <option value="name_1">1 items selected</option>
                                        </select>
                                    </div>
                                    <div class="filter-popup_row">
                                        <div class="title">Spendings</div>
                                        <div class="ranges range-double">
                                            <input type="text" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
                                        </div>
                                    </div>
                                    <div class="filter-popup_row">
                                        <div class="title">Clicks</div>
                                        <div class="ranges range-double">
                                            <input type="text" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
                                        </div>
                                    </div>
                                    <div class="filter-popup_row centered">
                                        <input type="submit" class="btn btn-blue" value="Filter">
                                    </div>
                                </form>
                            </div><!--/.filters-popup-->
                        </div>
                    </div>
                    @if(count($campaigns) > 0)
                        @foreach($campaigns as $campaign)
                            <div class="table-row">
                                <div class="table-col">
                                    <span class="title">Name:</span>
                                    <span class="value"><b>{{$campaign->title}}</b></span>
                                </div>
                                <div class="table-col">
                                    <span class="title">Av. CPC:</span>
                                    <span class="value">$<b>{{$campaign->get_spendings_average()}}</b></span>
                                </div>
                                <div class="table-col">
                                    <span class="title">Clicks:</span>
                                    <span class="value"><i class="icon-grow-down"></i> <b>{{$campaign->clicks}}</b></span>
                                </div>
                                <div class="table-col">
                                    <span class="title">Spending:</span>
                                    <span class="value"><i class="icon-grow-down"></i> $<b>{{$campaign->get_spendings_summ()}}</b></span>
                                </div>
                                <div class="table-col">
                                    <a href="#" class="details-btn"><span>Details</span> <i class="icon-arrow-right-c"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>{{ $user->name }} haven't campaigns</p>
                    @endif

                    <div class="table-footer table-footer-btn margin-24px_top padding-24px_bottom">
                        <a href="{{route('admin-users-campaigns-pagination')}}" data-pagination="campaigns" data-offset="0" data-limit="5" data-step="5" class="btn btn-bordered btn-icon"><i class="icon-arrow-down"></i> <span>Show more</span></a>
                    </div>
                </div><!--/.campaign-daily-table-->
            </div>
        </div>
        <div class="user-stats-box_r">
            <div class="user-balance">
                <div class="balance-box">
                    <div class="balance-box_title">
                        <span>Balance</span>
                    </div>
                    <div class="balance-box_graph">
                        <div class="balance-graph">
                            <canvas id="balance-graph" width="410px" height="150px" data-values="[@foreach($balance as $item=>$value) {{$value->value}} @if(!$loop->last),@endif @endforeach , 0]"></canvas>
                        </div>
                        <div class="balance-box_summ">
                            <span>$<b>{{$user->balance}}</b></span>
                        </div>
                    </div>
                    <div class="balance-box_change_wrap">
                        <div class="balance-box_change">
                            <div class="balance-change_icon {{$balance_week_class}}">
                                @if($balance_week_class == 'change-up')
                                    <i class="icon-growth-up"></i>
                                @elseif($balance_week_class == 'change-down')
                                    <i class="icon-growth-down"></i>
                                @else

                                @endif

                                <span> {{$balance_week}} </span>
                            </div>
                            <div class="balance-change_title">
                                <span>
                                    <b>weekly balance</b>
                                    (week to week)
                                </span>
                            </div>
                        </div>
                        <div class="balance-box_info">
                            <div class="balance-box_last">
                                <div class="label">Clicks:</div>
                                <div class="value">{{$user_clicks}}</div>
                            </div>
                            <div class="balance-box_amount">
                                <div class="label">Av. CPC:</div>
                                <div class="value">
                                    <span>$<b>{{$user_average_clicks}}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.balance-box-->
            </div>
        </div>
    </div>
@endsection