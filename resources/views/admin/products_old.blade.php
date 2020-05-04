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
                            <form action="{{route('filter-products')}}">
                                <div class="filter-popup_row">
                                    <div class="title">Sort by</div>
                                    <select name="sorting" id="sortby" class="sorting-select select-styled">
                                        <option value="desc">Last week’s spendings [descending]</option>
                                        <option value="asc">Last week’s spendings [ascending]</option>
                                    </select>
                                </div>

                                <div class="filter-popup_row">
                                    <div class="title">Name</div>
                                    <select name="name" id="name" class="sorting-select select-styled">
                                        @foreach($filter_rows as $key=>$value)
                                            @if($key == 'products')
                                                @foreach($value as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Campaigns</div>
                                    <div class="ranges range-double">
                                        @foreach($filter_rows as $key=>$value)
                                            @if($key == 'campaigns')
                                                <input type="text" class="input-slider-range range-integer" data-min="{{$value['min']}}" data-max="{{$value['max']}}" data-current="" name="filter_campaigns">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Last week’s spendings</div>
                                    <div class="ranges range-double">
                                        @foreach($filter_rows as $key=>$value)
                                            @if($key == 'last_week_spendings')
                                                @foreach($value as $item)
                                                    <input type="text" class="input-slider-range" data-min="{{$item['min']}}" data-max="{{$item['max']}}" data-current="1.52" name="filter_last_week_spendings">
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="filter-popup_row">
                                    <div class="title">Total spendings</div>
                                    <div class="ranges range-double">
                                        @foreach($filter_rows as $key=>$value)
                                            @if($key == 'total_spendings')
                                                @foreach($value as $item)
                                                    <input type="text" class="input-slider-range" data-min="{{$item['min']}}" data-max="{{$item['max']}}" data-current="1.52" name="filter_total_spendings">
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($list as $product)

                @if($product->subproducts)
                    <div class="table-row" data-product="{{ $product->id }}">
                        <div class="table-col">
                            <div class="title">Product:</div>
                            <div class="value"><b>{{$product->name}}</b></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Subproduct:</div>
                            <div class="value"><span>N/A</span></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Campaigns:</div>
                            <div class="value"><b>{{$product->campaigns_count}} campaigns</b></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Last week’s spendings:</div>
                            <div class="value"><i class="{{$product->spendings_icon}}"></i> $<b>{{$product->spendings_for_week}}</b></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Total spendings:</div>
                            <div class="value">$<b>{{$product->spendings_total}}</b></div>
                        </div>
                        <div class="table-col">
                            <a href="{{route('edit-product', $product->id)}}" class="details-btn"><span>Edit</span> <i class="icon-edit"></i></a>
                        </div>
                    </div><!--/.table-row-->

                    @foreach($product->subproducts as $key=>$subproduct)

                        <div class="table-row row-subproduct @if($key == 0) row-product @endif @if(count($product->subproducts) == $key+1) row-subproduct_last @endif">
                            <div class="table-col">
                                <div class="title">Product:</div>
                                <div class="value"><b>{{$product->name}}</b></div>
                            </div>
                            <div class="table-col">
                                <div class="title">Subproduct:</div>
                                <div class="value"><b>{{$subproduct->name}}</b></div>
                            </div>
                            <div class="table-col">
                                <div class="title">Campaigns:</div>
                                <div class="value"><b>{{$subproduct->campaigns_count}} campaigns</b></div>
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
                @else
                    <div class="table-row" data-product="{{ $product->id }}">
                        <div class="table-col">
                            <div class="title">Product:</div>
                            <div class="value"><b>{{$product->name}}</b></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Subproduct:</div>
                            <div class="value"><span>N/A</span></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Campaigns:</div>
                            <div class="value"><b>{{$product->campaigns_count}} campaigns</b></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Last week’s spendings:</div>
                            <div class="value">{{$product->spendings_icon}} $<b>{{$product->spendings_for_week}}</b></div>
                        </div>
                        <div class="table-col">
                            <div class="title">Total spendings:</div>
                            <div class="value">$<b>{{$product->spendings_total}}</b></div>
                        </div>
                        <div class="table-col">
                            <a href="{{route('edit-product', $product->id)}}" class="details-btn"><span>Edit</span> <i class="icon-edit"></i></a>
                        </div>
                    </div><!--/.table-row-->
                @endif

            @endforeach

            <div class="table-footer-btn padding-24px_top padding-24px_bottom">
                <a href="#" class="btn btn-bordered btn-icon"><i class="icon-arrow-down"></i><span>Show more</span></a>
            </div>
        </div><!--/.products-users-list-->
    </div><!--/.mainbar-main-->

@endsection