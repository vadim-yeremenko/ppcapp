 @extends('layouts.dashboard')

@section('content')
    <div class="mainbar-header dashboard-header filters-box">
        <div class="filters-box">
            <div class="title">
                <span>Campaigns</span>
            </div>
            <div class="filter-param">
                <div class="filter-param_title">
                    <span>during</span>
                </div>
                <div class="filter-param-date input-date-range">
                    <input type="text" class="datepicker date-filter" data-url="{{route('ajax-filter')}}" data-action="campaign_page">
                    <i class="icon-date"></i>
                </div>
            </div>
            <div class="more-filters">
                <a href="#" class="filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
                <div class="filters-popup">
                    <form action="{{route('ajax-filter')}}" id="filter-popup-campaign" class="filter-form" data-action="campaign_page">
                        <div class="filter-popup_row">
                            <div class="title">Product</div>
                            <select name="name" id="name" class="select-styled">
                                <option value="name_4">4 items selected</option>
                            </select>
                        </div>
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
                                <input type="text" name="clicks" class="input-slider-range" data-min="{{$campaign_filter['min_clicks']}}" data-max="{{$campaign_filter['max_clicks']}}" data-prefix=" " data-step="1">
                            </div>
                        </div>
                        <div class="filter-popup_row centered">
                            <input type="submit" class="btn btn-blue" value="Filter" id="filter_campaign">
                        </div>
                    </form>
                </div><!--/.filters-popup-->
            </div><!--/.more-filters-->
        </div><!--/.sidebar-header_l-->
    </div>
    <div class="mainbar-main">
        <div class="campaign-list">
            <div id="ajax-result">
                @foreach($campaigns as $campaign)
                    <div class="campaign" data-id="{{$campaign->id}}">
                        <div class="campaign_title">
                            <h3>{{$campaign->title}}</h3>
                        </div>
                        <div class="campaign_table table">
                            <div class="col_img">
                                <div class="image">
                                    <img src="{{$campaign->image}}">
                                </div>
                            </div>
                            <div class="col_started">
                                <span class="title">Started on:</span>
                                <span class="value"><b>{{$campaign->modified_date()}}</b></span>
                            </div>
                            <div class="col_bid">
                                <span class="title">CPC Bid:</span>
                                <span class="value"><i class="icon-grow-down"></i>$<b>{{$campaign->cpc}}</b></span>
                            </div>
                            <div class="col_spending">
                                <span class="title">Spending:</span>
                                <span class="value"><i class="icon-grow-up"></i>$<b>{{$campaign->spendings_summ()}}</b></span>
                            </div>
                            <div class="col_clicks">
                                <span class="title">Clicks:</span>
                                <span class="value"><b>{{$campaign->get_clicks_count()}}</b></span>
                            </div>
                            <div class="col_btns">
                                <a href="{{route('campaign-details', ['id' => $campaign->id])}}" class="details-btn"><span>Details</span> <i class="icon-running"></i></a>
                                <a href="#disable-campaign" data-fancybox class="deactivate-btn deactivate-campaign" data-campaign="{{$campaign->id}}" data-title="{{$campaign->title}}"><span>Deactivate campaign</span> <i class="icon-cross"></i></a>
                            </div>
                        </div>
                    </div><!--/campaign.-->
                @endforeach
            </div>
        </div><!--/.campaigns-list-->
        @if(count($campaigns) > 6)
            <div class="campaigns-list_footer margin-24px_top">
                <a href="{{route('campaign')}}" class="btn btn-bordered btn-icon"><i class="icon-arrow-down"></i> <span>Show more</span></a>
            </div>
        @endif
    </div><!--/.mainbar-main-->
    <div id="disable-campaign" class="popup" style="display: none;">
        <div class="popup_title"><h3>Disable campaign</h3></div>
        <div class="popup_body">
            <span class="disable_title">
                Are you sure you want to disable  <br> the <b class="campaign-title"></b> campaign?
            </span>
            <span class="disable_subtitle">
                Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
            </span>
            <span>
                <a href="#" class="btn btn-blue btn-icon btn-disable-campaign" data-campaign="" data-action="{{route('campaigns_disable')}}"><i class="icon-check-white"></i> <span>Yes, please disable campaign</span></a>
            </span>
            <span>
                <a href="#" class="btn btn-bordered btn-icon close-popup"><i class="icon-close"></i> <span>No, continue campaign</span></a>
            </span>
        </div>
    </div>
@endsection