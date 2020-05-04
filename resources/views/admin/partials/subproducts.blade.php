@foreach($subproducts as $subproduct)
    <div class="table-row">
        <div class="table-col">
            <div class="title">Subproduct:</div>
            <div class="value"><b>{{$subproduct->name}}</b></div>
        </div>
        <div class="table-col">
            <div class="title">Campaigns:</div>
            <div class="value"><b>{{$subproduct->campaigns_count()}}</b></div>
        </div>
        <div class="table-col">
            <div class="title">Last week’s spendings:</div>
            <div class="value"><i class="{{$subproduct->spendings_icon()}}"></i> $<b>{{$subproduct->spendings_last_week()}}</b></div>
        </div>
        <div class="table-col">
            <div class="title">Total spendings:</div>
            <div class="value">$<b>{{$subproduct->spendings_total()}}</b></div>
        </div>
        <div class="table-col">
            <a href="{{route('edit-subproduct', $subproduct->id)}}" class="details-btn"><span>Edit</span> <i class="icon-edit"></i></a>
        </div>
    </div><!--/.table-row-->
@endforeach