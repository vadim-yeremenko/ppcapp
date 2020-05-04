<div class="balance-box">
    <div class="balance-box_title">
        <span>Users’ total balance</span>
    </div>
    <div class="flex-row">
        <div class="balance-box_graph">
            <div class="balance-graph">
                <canvas id="balance-graph_right" width="410px" height="150px"></canvas>
            </div>
            <div class="balance-box_summ">
                <span>$<b>{{$all_users_charges}}</b></span>
            </div>
        </div>
        <div class="balance-box_change">
            <div class="balance-change_icon {{$all_users_charges_changing_icon}}">
                <span> {{$all_users_charges_changing}} </span>
            </div>
            <div class="balance-change_title">
                <span>
                    <b>weekly balance</b>
                    (week to week)
                </span>
            </div>
        </div>
    </div>
</div><!--/.balance-box-->