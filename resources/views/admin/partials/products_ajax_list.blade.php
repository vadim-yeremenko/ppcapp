@foreach($products_list as $product)
    @include('admin.partials.product_item')
@endforeach
@if(count($products_list) > 5)
    <div class="table-footer-btn">
        <a href="{{route('products-list')}}" class="btn btn-bordered" id="filter_products_dashboard"><span>View All</span></a>
    </div>
@endif