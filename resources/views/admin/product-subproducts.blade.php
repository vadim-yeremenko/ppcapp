@extends('layouts.admin')

@section('content')

    <div class="mainbar-header subproducts-list-header">
        <div class="col">
            <div class="dashboard-header-back">
                <a href="{{route('admin-products')}}">Product: <span>{{$product_title}}</span></a>
            </div>
        </div>
        <div class="col ">
            <a href="#" class="btn btn-blue btn-icon"><i class="icon-plus"></i> <span>Add new product</span></a>
        </div>
    </div>
    <div class="mainbar-main">

        <div class="table table-box subproducts-info-table margin-32px_top">
            <div class="table-head">
                <div class="col">
                    <span>Subproducts</span>
                </div>
                <div class="col">
                    <div class="more-filters">
                        <a href="#filter-product" class="btn-filters filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
                        <div class="filters-popup">
                            <form action="{{route('filter-subproducts', $product_id)}}" method="POST" class="filter-form" id="subproducts_filter">
                                <div class="filter-popup_row">
                                    <div class="title">Sort by</div>
                                    <select name="sorting" id="sortby" class="sorting-select select-styled">
                                        <option value="last_week-desc">Last week’s spendings [descending]</option>
                                        <option value="last_week_asc">Last week’s spendings [ascending]</option>
                                        <option value="total_desc">Total spendings [descending]</option>
                                        <option value="total_asc">Last week’s spendings [ascending]</option>
                                        <option value="name_desc">Name [descending]</option>
                                        <option value="name_asc">Name [ascending]</option>
                                    </select>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Campaigns</div>
                                    <div class="ranges range-double">
                                        <input type="text" name="campaigns" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Last week’s spendings</div>
                                    <div class="ranges range-double">
                                        <input type="text" name="last_week_spendings" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Total spendings</div>
                                    <div class="ranges range-double">
                                        <input type="text" name="total_spendings" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
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
            <div id="ajax-result">
            @foreach($subproducts as $subproduct)
                <div class="table-row">
                    <div class="table-col">
                        <div class="title">Subproduct:</div>
                        <div class="value"><b>{{$subproduct->name}}</b></div>
                    </div>
                    <div class="table-col">
                        <div class="title">Campaigns:</div>
                        <div class="value"><b>{{$subproduct->campaigns_count}}</b></div>
                    </div>
                    <div class="table-col">
                        <div class="title">Last week’s spendings:</div>
                        <div class="value"><i class="{{$subproduct->spendings_icon}}"></i> $<b>{{$subproduct->spendings_for_week}}</b></div>
                    </div>
                    <div class="table-col">
                        <div class="title">Total spendings:</div>
                        <div class="value">$<b>{{$subproduct->spendings_total}}</b></div>
                    </div>
                    <div class="table-col">
                        <a href="{{route('edit-subproduct', $subproduct->id)}}" class="details-btn"><span>Edit</span> <i class="icon-edit"></i></a>
                    </div>
                </div><!--/.table-row-->
            @endforeach
            </div>
            <div class="table-footer-btn padding-24px_top padding-24px_bottom">
                <a href="{{route('filter-subproducts', $product_id)}}" class="btn btn-bordered btn-icon" data-pagination="1" data-filter="subproducts_filter"><i class="icon-arrow-down"></i><span>Show more</span></a>
            </div>
        </div><!--/.products-users-list-->
    </div><!--/.mainbar-main-->

@endsection