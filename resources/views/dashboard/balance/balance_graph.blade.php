<div class="balance-box">
    <div class="balance-box_title">
        <span>Balance</span>
    </div>
    <div class="balance-box_graph">
        <div class="balance-graph">
            <canvas id="balance-graph" width="410px" height="150px" data-labels="@foreach($charges_graph_list as $charge){{$charge}},@endforeach"></canvas>
        </div>
        <div class="balance-box_summ">
            <span>$<b>{{$charges_graph_balance}}</b></span>
        </div>
    </div>
    <div class="balance-box_info">
        @if($charges_graph_last)
            <div class="balance-box_last">
                <div class="label">Last Charge:</div>
                <div class="value">{{$charges_graph_last->modified_date()}}</div>
            </div>
            <div class="balance-box_amount">
                <div class="label">Amount:</div>
                <div class="value">
                    <span>$<b>{{$charges_graph_last->value}}</b></span>
                </div>
            </div>
        @endif
    </div>
    <div class="balance-box_btn">
        <a href="{{route('charge')}}" class="btn btn-icon btn-blue"><i class="icon-plus"></i> <span>Charge account</span></a>
    </div>
</div><!--/.balance-box-->