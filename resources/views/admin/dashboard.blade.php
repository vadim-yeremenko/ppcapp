@extends('layouts.admin')

@section('content')
    @include('admin.main.full_statistics')

    <div class="mainbar-main">
        @include('admin.main.stats_chart')
        <div id="ajax_table_result">
            @include('admin.main.dashboard_products')
        </div>
    </div><!--/.mainbar-main-->
@endsection