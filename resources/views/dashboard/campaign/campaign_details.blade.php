<div class="campaign-details-col">
    <div class="campaign-details-box">
        <div class="campaign-details-box_head">
            <span class="h4-like">Details</span>
        </div>
        <div class="campaign-details-box_row">
            <div class="col">
                <span class="title">Product:</span>
                <span class="value" title="{{$product_full}}">{{$product}}</span>
            </div>
            <div class="col">
                <span class="title">Starting date:</span>
                <span class="value" title="{{$subproduct_full}}">{{$campaign->modified_date()}}</span>
            </div>
        </div>
        <div class="campaign-details-box_row">
            @if(!empty($subproduct))
                <div class="col">
                    <span class="title">Subproduct:</span>
                    <span class="value">{{$subproduct}}</span>
                </div>
            @endif

            <div class="col">
                <span class="title">CPC Bid:</span>
                <span class="value">${{$campaign->cpc}}</span>
            </div>
        </div>
        <div class="campaign-details-box_row">
            <div class="col">
                <span class="title">URL:</span>
                <span class="value"><a href="{{$url_full}}" class="url-btn" title="{{$url_full}}" target="_blank"><span>{{$url}}</span> <i class="icon-url"></i></a></span>
            </div>
        </div>
        <div class="campaign-details-box_footer">
            <a href="{{route('campaign-edit', $campaign->id)}}" class="btn btn-blue btn-icon"><i class="icon-edit-white"></i><span>Edit</span></a>
        </div>
    </div><!--/.campaign-details-box-->
    <div class="campaign-details-col_btn">
        <div class="centered margin-24px_top">
            <a href="#" class="btn btn-bordered" data-fancybox><span>Disable campaign</span></a>
        </div>
    </div>
</div><!--/.campaign-details-col-->