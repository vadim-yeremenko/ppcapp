@extends('layouts.admin')

@section('content')

    <div class="mainbar-header products-list-header">
        <div class="col">
            <div class="title">Products:</div>
            <div class="value">{{$products_count}} <a href="{{route('products-list')}}"><i class="icon-arrow-right-c"></i></a></div>
        </div>
        <div class="col">
            <div class="title">Subproducts:</div>
            <div class="value">{{$subproducts_count}}</div>
        </div>
        <div class="col">
            <a href="{{ route('add-product') }}" class="btn btn-blue btn-icon"><i class="icon-plus"></i><span>Add New product</span></a>
        </div>
    </div>
    <div class="mainbar-main">
        <div class="table table-box products-table-box products-info-table margin-32px_top">
            <div class="table-head">
                <div class="col">
                    <span>Products</span>
                </div>
                <div class="col">
                    <div class="more-filters">
                        <a href="#filter-product" class="btn-filters filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
                        <div class="filters-popup">
                            <form action="{{route('admin-ajax-filter')}}" data-action="filter_products_subproducts" data-redirect="1" class="filter-form" data-result="products_filter_result">
                                <div class="filter-popup_row">
                                    <div class="title">Sort by</div>
                                    <select name="sorting" id="sortby" class="sorting-select select-styled">
                                        <option value="spendings_last_week-desc">Last week’s spendings [descending]</option>
                                        <option value="spendings_last_week-asc">Last week’s spendings [ascending]</option>
                                        <option value="spendings_total-desc">Total spendings [descending]</option>
                                        <option value="spendings_total-asc">Total spendings [ascending]</option>
                                        <option value="campaigns_count-desc">Campaigns count [descending]</option>
                                        <option value="campaigns_count-asc">Campaigns count [ascending]</option>
                                    </select>
                                </div>

                                <div class="filter-popup_row">
                                    <div class="title">Campaigns</div>
                                    <div class="ranges range-double">
                                        <input type="text" class="input-slider-range" data-min="{{$filter_value['campaigns_count_min']}}" data-max="{{$filter_value['campaigns_count_max']}}" name="campaigns_count" data-prefix=" " data-step="1">
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Total spendings</div>
                                    <div class="ranges range-double">
                                        <input type="text" class="input-slider-range" data-min="{{$filter_value['total_spendings_min']}}" data-max="{{$filter_value['total_spendings_max']}}" name="total_spendings" data-step="1">
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Last week spendings</div>
                                    <div class="ranges range-double">
                                        <input type="text" class="input-slider-range" data-min="{{$filter_value['lw_spendings_min']}}" data-max="{{$filter_value['lw_spendings_max']}}" name="lw_spendings" data-step="1">
                                    </div>
                                </div>
                                <div class="filter-popup_row centered">
                                    <input type="submit" class="btn btn-blue filter_button" value="Filter">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="products_filter_result">
                @include('admin.partials.products_subproducts_list')
            </div>
        </div><!--/.products-users-list-->
    </div><!--/.mainbar-main-->

@endsection