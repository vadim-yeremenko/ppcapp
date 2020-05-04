@foreach($products_array as $id=>$product)
    @if($product['type'] == 'product')
        <div class="table-row" data-product="{{ $id }}">
            <div class="table-col">
                <div class="title">Product:</div>
                <div class="value"><b>{{$product['name']}}</b></div>
            </div>
            <div class="table-col">
                <div class="title">Subproduct:</div>
                <div class="value"><span>N/A</span></div>
            </div>
            <div class="table-col">
                <div class="title">Campaigns:</div>
                <div class="value"><b>{{$product['campaigns_count']}} campaigns</b></div>
            </div>
            <div class="table-col">
                <div class="title">Last week’s spendings:</div>
                <div class="value"><i class="{{$product['spendings_last_week_icon']}}"></i> $<b>{{$product['spendings_last_week']}}</b></div>
            </div>
            <div class="table-col">
                <div class="title">Total spendings:</div>
                <div class="value">$<b>{{$product['spendings_total']}}</b></div>
            </div>
            <div class="table-col">
                <a href="{{route('edit-product', $product['id'])}}" class="details-btn"><span>Edit</span> <i class="icon-edit"></i></a>
            </div>
        </div><!--/.table-row-->
    @else
        <div class="table-row row-subproduct @if($product['idx'] == '1') row-product @endif @if($product['last']) row-subproduct_last @endif">
            <div class="table-col">
                <div class="title">Product:</div>
                <div class="value"><b>{{$product['product_name']}}</b></div>
            </div>
            <div class="table-col">
                <div class="title">Subproduct:</div>
                <div class="value"><span>{{$product['name']}}</span></div>
            </div>
            <div class="table-col">
                <div class="title">Campaigns:</div>
                <div class="value"><b>{{$product['campaigns_count']}} campaigns</b></div>
            </div>
            <div class="table-col">
                <div class="title">Last week’s spendings:</div>
                <div class="value"><i class="{{$product['spendings_last_week_icon']}}"></i> $<b>{{$product['spendings_last_week']}}</b></div>
            </div>
            <div class="table-col">
                <div class="title">Total spendings:</div>
                <div class="value">$<b>{{$product['spendings_total']}}</b></div>
            </div>
            <div class="table-col">
                <a href="{{route('edit-subproduct', $product['id'])}}" class="details-btn"><span>Edit</span> <i class="icon-edit"></i></a>
            </div>
        </div><!--/.table-row-->
    @endif

@endforeach

<div class="table-footer-btn padding-24px_top padding-24px_bottom">
    <a href="#" class="btn btn-bordered btn-icon"><i class="icon-arrow-down"></i><span>Show more</span></a>
</div>