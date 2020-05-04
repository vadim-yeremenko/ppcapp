<div class="table table-box products-table products-table_style-1 margin-32px_top tabs">
    <div class="table-head">
        <div class="col">
            <div class="products-table_nav tabs-switcher">
                <a href="#" class="btn-link btn-ajax active" data-url="{{route('admin-ajax')}}" data-ajax="show_products">Products</a>
                <span> / </span>
                <a href="#" class="btn-link btn-ajax" data-url="{{route('admin-ajax')}}" data-ajax="show_users">Users</a>
            </div>
        </div>
        <div class="col">
            <div class="more-filters">
                <a href="#" class="btn-filters filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
                <div class="filters-popup">
                    <form action="{{route('admin-ajax-filter')}}" data-action="filter_products_dashboard" data-redirect="1" class="filter-form" data-result="products_result_ajax">
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
                                <input type="text" class="input-slider-range" name="lw_spendings" data-min="{{$product_filter_val['lw_spendings_min']}}" data-max="{{$product_filter_val['lw_spendings_max']}}" data-step="1">
                            </div>
                        </div>
                        <div class="filter-popup_row">
                            <div class="title">Total spendings</div>
                            <div class="ranges range-double">
                                <input type="text" class="input-slider-range" name="total_spendings" data-min="{{$product_filter_val['total_spendings_min']}}" data-max="{{$product_filter_val['total_spendings_max']}}" data-step="1">
                            </div>
                        </div>
                        <div class="filter-popup_row">
                            <div class="title">Campaigns</div>
                            <div class="ranges range-double">
                                <input type="text" class="input-slider-range" name="campaigns" data-min="{{$product_filter_val['campaigns_min']}}" data-max="{{$product_filter_val['campaigns_max']}}" data-step="1" data-prefix=" ">
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
    <div class="tabs-content-wrap">
        <div class="tabs-content show" data-content="products">
            <div class="tabs-content_wrapper">
                <div id="products_result_ajax">
                    @include('admin.partials.products_ajax_list')
                </div>
            </div>
        </div>
    </div>
</div><!--/.products-users-list-->