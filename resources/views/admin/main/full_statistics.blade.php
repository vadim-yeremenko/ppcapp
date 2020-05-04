<div class="mainbar-header dashboard-header">

    <div class="dashboard-header_l">
        <div class="campaign-info">
            <div class="title">Running campaigns:</div>
            <div class="value"><b>{{$stats_campaigns}}</b></div>
        </div><!--/.campaign-info-->
        <div class="campaign-info">
            <div class="title">Last week’s spendings:</div>
            <div class="value">$<b>{{$stats_spendings['count']}}</b><span class="change {{$stats_spendings['icon']}}">{{$stats_spendings['difference']}}</span></div>
        </div><!--/.campaign-info-->
        <div class="campaign-info">
            <div class="title">Last week’s clicks:</div>
            <div class="value"><b>{{$stats_clicks['count']}}</b><span class="change {{$stats_clicks['icon']}}">{{$stats_clicks['difference']}}</span></div>
        </div><!--/.campaign-info-->
    </div><!--/.sidebar-header_l-->

    <div class="dashboard-header_r">
        <a href="{{ route('add-product') }}" class="btn btn-blue btn-icon"><i class="icon-plus"></i><span>Add new product</span></a>
    </div><!--/.sidebar-header_r-->

</div>