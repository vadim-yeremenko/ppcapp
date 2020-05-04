<div class="table-row table-row-products">
    <div class="col">
        <div class="title">Product:</div>
        <div class="value"><b>{{$product->name}}</b></div>
    </div>
    <div class="col">
        <div class="title">Campaigns:</div>
        <div class="value"><b>{{$product->campaigns_count}} campaigns</b></div>
    </div>
    <div class="col">
        <div class="title">Last week’s spendings:</div>
        <div class="value"><i class="{{$product->spendings_icon()}}"></i> $<b>{{$product->spendings_last_week}}</b></div>
    </div>
    <div class="col">
        <div class="title">Total spendings:</div>
        <div class="value">$<b>{{$product->spendings_total}}</b></div>
    </div>
    <div class="col">
        <a href="{{route('product-subproducts', $product->id)}}" class="details-btn"><span>Details</span> <i class="icon-arrow-right-c"></i></a>
    </div>
</div><!--/.table-row-->