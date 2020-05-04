@extends('layouts.admin')

@section('content')

    <div class="mainbar-main">
        <div class="input-box input-box-cpc">
            <div class="input-box_l input-box_flex">
                <div class="col">
                    <div class="input-box_title">
                        <span>Minimal CPC Bid</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="input-field" placeholder="Please insert URL for product..." name="product_name" required>
                        <span class="input-field-status"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="input-box_title">
                        <span>Maximal CPC Bid</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="input-field" placeholder="Please insert URL for product..." name="product_name" required>
                        <span class="input-field-status"></span>
                    </div>
                </div>
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="table table-box table-cpc products-info-table margin-32px_top">
            <div class="table-head">
                <div class="col">
                    <span>Products</span>
                </div>
                <div class="col">
                    <div class="more-filters">
                        <a href="#filter-product" class="btn-filters filter-popup-open"><span>Filters</span><i class="icon-filters"></i></a>
                        <div class="filters-popup">
                            <form action="#">
                                <div class="filter-popup_row">
                                    <div class="title">Sort by</div>
                                    <select name="name" id="sortby" class="sorting-select select-styled">
                                        <option value="name_4">Last week’s spendings [descending]</option>
                                        <option value="name_3">Last week’s spendings [ascending]</option>
                                    </select>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Name</div>
                                    <select name="name" id="name" class="sorting-select select-styled">
                                        <option value="name_4">Tristique</option>
                                        <option value="name_3">Tristique another one</option>
                                    </select>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Last week’s spendings</div>
                                    <div class="ranges range-double">
                                        <input type="text" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Total spendings</div>
                                    <div class="ranges range-double">
                                        <input type="text" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">User balance</div>
                                    <div class="ranges range-double">
                                        <input type="text" class="input-slider-range" data-min="0.9" data-max="2.25" data-current="1.52">
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
            @include('admin.partials.products_subproducts_list')

        </div><!--/.products-users-list-->
    </div><!--/.mainbar-main-->

@endsection