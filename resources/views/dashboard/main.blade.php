@extends('layouts.dashboard')

@section('content')
    @include('dashboard.main.dashboard_statistics')
    <div class="mainbar-main">
        @include('dashboard.main.dashboard_bars')
        <div class="flex-row flex-between margin-16px_top flex-align-top mobile-flex-column">
            @include('dashboard.main.dashboard_campaigns')
            @include('dashboard.main.dashboard_balance')
        </div>
    </div><!--/.mainbar-main-->
@endsection