<div class="charges-list-table table">
    <div class="table-head">
        <div class="table-col">
            <span class="h4-like">List of charges</span>
        </div>
        <div class="table-col ta-right more-filters">
            <a href="#" class="filter-popup-open btn-filters"><span>Filters</span><i class="icon-filters"></i></a>
            <div class="filters-popup">
                <form action="{{route('ajax-filter')}}" id="daily_overview" class="filter-form" data-action="daily_overview" data-result="daily_overview_result">
                    <div class="filter-popup_row">
                        <div class="filter-calendar">
                            <input type="text" name="date" class="date-picker-calendar" value="">
                        </div>
                    </div>
                    <div class="filter-popup_row">
                        <div class="title">Amount</div>
                        <div class="ranges range-double">
                            <input type="text" name="spending" class="input-slider-range" data-min="" data-max="" >
                        </div>
                    </div>
                    <div class="filter-popup_row centered">
                        <input type="submit" class="btn btn-blue" value="Filter">
                    </div>
                </form>
            </div><!--/.filters-popup-->
        </div>
    </div>
    @foreach($charges_list as $charge)
        @include('dashboard.balance.partials.balance_charge_item')
    @endforeach
    <div class="table-footer-btn margin-24px_top">
        <a href="#" class="btn btn-bordered btn-icon"><i class="icon-arrow-down"></i> <span>Show more</span></a>
    </div>
</div>