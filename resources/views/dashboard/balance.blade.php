@extends('layouts.dashboard')

@section('content')
    <div class="title-underlined margin-24px_top">
        <h2>Balance</h2>
    </div>
    <div class="mainbar-main">
        <div class="flex-row flex-between balance-page mobile-flex-column">
            <div class="col">
                @include('dashboard.balance.balance_graph')
{{--                @include('dashboard.balance.spent_box')--}}
{{--                @include('dashboard.balance.balance_info')--}}
            </div>
            <div class="col">
                @include('dashboard.balance.list_of_charges')
            </div>
        </div><!--/.balance-page-->
    </div><!--/.mainbar-main-->
@endsection