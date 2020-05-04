@extends('layouts.admin')

@section('content')

    <div class="rounded-white-box margin-24px_top">
        <div class="flex-row user-balance-box">
            <div class="col">
                @include('admin.balance.balance_users_spendings')
            </div>
            <div class="col">
                @include('admin.balance.balance_users_total')
            </div>
        </div>
        <div class="table products-table table-balance-users margin-8px_top">
            <div class="table-head">
                <div class="col">
                    <span class="h4-like">Users</span>
                </div>
                <div class="col">
                    <div class="more-filters">
                        <a href="#filter-product" class="btn-filters filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
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
    </div>

@endsection