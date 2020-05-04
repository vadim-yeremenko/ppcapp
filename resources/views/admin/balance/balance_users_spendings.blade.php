<div class="balance-box">
    <div class="balance-box_title">
        <span>Users' spending</span>
    </div>
    <div class="flex-row">
        <div class="balance-box_graph">
            <div class="balance-graph">
                <canvas id="balance-graph_left" width="410px" height="150px" data-values="[@foreach($all_users_spendings_graph as $value) {{$value}} @if(!$loop->last),@endif @endforeach]"></canvas>
            </div>
            <div class="balance-box_summ">
                <span>$<b>{{$all_users_spendings}}</b></span>
            </div>
        </div>
        <div class="balance-box_info">
            <div class="balance-box_change">
                <div class="balance-change_icon {{$all_users_spendings_changing_icon}}">
                    <span> {{$all_users_spendings_changing}} </span>
                </div>
                <div class="balance-change_title">
                    <span>
                        <b>weekly balance</b>
                        (week to week)
                    </span>
                </div>
            </div>
            <div class="balance-box_stats">
                <div class="balance-box_last">
                    <div class="label">Clicks:</div>
                    <div class="value">{{$all_clicks_last_week}}</div>
                </div>
                <div class="balance-box_amount">
                    <div class="label">Av. CPC:</div>
                    <div class="value">
                        <span>$<b>{{$average_cpc}}</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/.balance-box-->