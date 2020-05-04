@extends('layouts.admin')

@section('content')
    <div id="content">
        <div class="mainbar-main">
            <div class="table table-box products-table margin-32px_top">
                <div class="table-head">
                    <div class="col">
                        <div class="products-table_nav">
                            <a href="{{route('admin-users-ajax-type')}}" data-usersajax="active" class="btn-link active">Users</a>
                            @if($requests > 0)
                                <span> / </span>
                                <a href="{{route('admin-users-ajax-type')}}" data-usersajax="nonactive" class="btn-link">New requests<span class="count">{{$requests}}</span></a>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="more-filters">
                            <a href="#" class="btn-filters filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
                            <div class="filters-popup">
                                <form action="{{route('admin-ajax-filter')}}" data-action="filter_users" data-redirect="1" class="filter-form" data-result="results-users" id="filter_users">
                                    <div class="filter-popup_row">
                                        <div class="title">Sort by</div>
                                        <select name="sorting" id="sorting" class="sorting-select select-styled">
                                            <option value="spendings_last_week-desc">Last week’s spendings [descending]</option>
                                            <option value="spendings_last_week-asc">Last week’s spendings [ascending]</option>
                                            <option value="spendings_total-desc">Total spendings [descending]</option>
                                            <option value="spendings_total-asc">Total spendings [ascending]</option>
                                            <option value="campaigns_count-desc">Campaigns count [descending]</option>
                                            <option value="campaigns_count-asc">Campaigns count [ascending]</option>
                                        </select>
                                    </div>
                                    <div class="filter-popup_row">
                                        <div class="title">Last week’s spendings</div>
                                        <div class="ranges range-double">
                                            <input type="text" class="input-slider-range" name="lw_spendings" data-min="{{$user_filter_val['lw_spendings_min']}}" data-max="{{$user_filter_val['lw_spendings_max']}}" data-step="1">
                                        </div>
                                    </div>
                                    <div class="filter-popup_row">
                                        <div class="title">Total spendings</div>
                                        <div class="ranges range-double">
                                            <input type="text" class="input-slider-range" name="total_spendings" data-min="{{$user_filter_val['total_spendings_min']}}" data-max="{{$user_filter_val['total_spendings_max']}}" data-step="1">
                                        </div>
                                    </div>
                                    <div class="filter-popup_row">
                                        <div class="title">Campaigns</div>
                                        <div class="ranges range-double">
                                            <input type="text" class="input-slider-range" name="campaigns" data-min="{{$user_filter_val['campaigns_min']}}" data-max="{{$user_filter_val['campaigns_max']}}" data-step="1" data-prefix=" ">
                                        </div>
                                    </div>
                                    <div class="filter-popup_row">
                                        <div class="title">Current balance</div>
                                        <div class="ranges range-double">
                                            <input type="text" class="input-slider-range" name="campaigns" data-min="{{$user_filter_val['campaigns_min']}}" data-max="{{$user_filter_val['campaigns_max']}}" data-step="1" data-prefix=" ">
                                        </div>
                                    </div>
                                    <div class="filter-popup_row centered">
                                        <input type="submit" class="btn btn-blue" value="Filter">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="results-users">
                    @include('admin.users.users_list')
                </div>
            </div><!--/.products-users-list-->
        </div><!--/.mainbar-main-->
    </div>

    <div class="popup" id="decline-user-popup" style="display: none;">
        <div class="popup_title">
            <span>Decline user</span>
        </div>
        <form method="POST" id="decline-user-form" action="{{route('admin-users-request-decline')}}">
            <input type="hidden" name="user" value="">
            @csrf
            <div class="popup-content">
                <div class="form-item top-label">
                    <label for="user_decline_message">You can add message to user (not required):</label>
                    <textarea name="user_decline_message" id="user_decline_message" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="popup-footer">
                <a href="#" class="btn btn-bordered close-popup">Cancel</a>
                <button type="submit" class="btn btn-blue margin-24px_left">Decline user</button>
            </div>
        </form>
    </div><!--/.auth-popup-->
@endsection