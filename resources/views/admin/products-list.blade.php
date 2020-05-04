@extends('layouts.admin')

@section('content')
    <div class="mainbar-header subproducts-list-header">
        <div class="col">
            <div class="dashboard-header-back">
                <a href="{{ route('admin-products') }}"><span>Product List</span></a>
            </div>
            <div class="dashboard-header-filter more-filters">
                <a href="#" class="btn-filters filter-popup-open"><span>Filters</span> <i class="icon-filters"></i></a>
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
        <div class="col ">
            <a href="{{route('add-product')}}" class="btn btn-blue btn-icon"><i class="icon-plus"></i> <span>Add new product</span></a>
        </div>
    </div>
    <div class="mainbar-main">
        <div class="product-list">
            @foreach($products_list as $product)
                <div class="product-item">
                    <div class="product-item_title">
                        <div class="col"><span class="title">{{$product->name}}</span></div>
                        <div class="col"><span class="counter">{{$product->subproducts_count}}</span></div>
                    </div>
                    <div class="product-item_body">
                        <div class="col">
                            <div class="title">
                                Last week’s spendings:
                            </div>
                            <div class="value">
                                <i class="{{$product->spendings_icon}}"></i> $<b>{{$product->spendings_for_week}}</b>
                            </div>
                        </div>
                        <div class="col">
                            <div class="title">
                                Total spendings:
                            </div>
                            <div class="value">
                                $<b>{{$product->spendings_total}}</b>
                            </div>
                        </div>
                    </div>
                    <div class="product-item_footer">
                        <a href="{{route('edit-product', $product->id)}}" class="more-details-btn btn-bg-dark"><span>Edit</span> <i class="icon-edit"></i></a>
                        <a href="{{route('product-subproducts', $product->id)}}" class="more-details-btn"><span>View</span> <i class="icon-arrow-right-c"></i></a>
                    </div>
                </div><!--/.product-item-->
            @endforeach

        </div><!--/.product-list-->
    </div><!--/.mainbar-main-->
@endsection