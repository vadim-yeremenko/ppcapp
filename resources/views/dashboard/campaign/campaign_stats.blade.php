<div class="mainbar-header dashboard-header">
    <div class="dashboard-header_l">
        <div class="campaign-info">
            <div class="title">Last week’s spendings:</div>
            <div class="value">$<b>{{$statistics['lw_spendings']}}</b><span class="change {{$statistics['lw_spendings_icon']}}">{{$statistics['lw_spendings_difference']}}</span></div>
        </div><!--/.campaign-info-->
        <div class="campaign-info">
            <div class="title">Last week’s clicks:</div>
            <div class="value"><b>{{$statistics['lw_clicks']}}</b><span class="change {{$statistics['lw_clicks_icon']}}">{{$statistics['lw_clicks_difference']}}</span></div>
        </div><!--/.campaign-info-->
        <div class="campaign-info">
            <div class="title">Total spendings:</div>
            <div class="value">$<b>{{$statistics['spendings']}}</b></div>
        </div><!--/.campaign-info-->
        <div class="campaign-info">
            <div class="title">Total clicks:</div>
            <div class="value"><b>{{$statistics['clicks']}}</b></div>
        </div><!--/.campaign-info-->
    </div><!--/.sidebar-header_l-->
</div>