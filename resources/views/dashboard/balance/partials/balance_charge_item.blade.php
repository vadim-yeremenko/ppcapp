<div class="table-row">
    <div class="table-col">
        <span class="title">Date:</span>
        <span class="value"><b>{{$charge->modified_date()}}</b></span>
    </div>
    <div class="table-col">
        <span class="title">Amount:</span>
        <span class="value">$<b>{{$charge->value}}</b></span>
    </div>
    <div class="table-col">
        <span class="title">Balance:</span>
        <span class="value">$<b>{{$charge->balance}}</b></span>
    </div>
    <div class="table-col">
        <a href="#" class="btn-invoice"><span>Invoice</span> <i class="icon-download"></i></a>
    </div>
</div>