@extends('layouts.dashboard')

@section('content')
    <div class="mainbar-main margin-24px_top">
    <div class="title-underlined padding-16px_left">
        <h2>Edit campaign</h2>
    </div>
    <form action="{{ route('add-campaign-process') }}" method="POST">
        {{ csrf_field() }}
        <div class="input-box">
            <div class="input-box_l">
                <div class="input-box_title">
                    <span>Campaign name</span>
                </div>
                <div class="input-box_input input-field-required">
                    <input type="text" class="input-field" placeholder="Please insert your name for campaign..." value="{{$campaign->title}}" name="title">
                    <span class="input-field-status"></span>
                </div>
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="input-box">
            <div class="input-box_l">
                <div class="input-box_title">
                    <span>Campaign URL</span>
                </div>
                <div class="input-box_input input-field-required">
                    <input type="text" class="input-field input-url" placeholder="Please insert your URL for campaign..." value="{{$campaign->url}}" name="url">
                    <span class="input-field-status"></span>
                </div>
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="input-box">
            <div class="input-box_l">
                <div class="input-box_title">
                    <span>Product</span>
                </div>
                <div class="input-box_input input-box_select">
                    <select name="product" id="product" class="select-styled change-cpc-ajax" data-placeholder="Select product">
                        <option value=""></option>
                        @foreach ($products_list as $product)
                            <option value="{{$product->id}}" @if($product->id == $campaign->product_id) selected @endif>{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="input-box input-box-sub" @if(empty($campaign->subproduct_id)) style="display: none" @endif>
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Sub product</span>
                    </div>
                    <div class="input-box_input input-box_select">
                        <select name="sub_product" id="sub_product" class="select-styled change-cpc-ajax" data-placeholder="Select sub product">
                            <option value=""></option>
                            @if(!empty($campaign->subproduct_id))
                                @foreach($subproducts as $subproduct)
                                    <option value="{{$subproduct->id}}" @if($campaign->subproduct_id == $subproduct->id) selected @endif>{{$subproduct->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                    </div>
                </div><!--/.input-box_r-->
            </div>
        </div><!--/.input-box-->

        <div class="input-box cpc-bid-range-ajax" @if($bid_type != 'range') style="display: none" @endif>
            <div class="input-box_l">
                <div class="input-box_title">
                    <span>CPC Bid</span>
                </div>
                <div class="input-box_row">
                    <div class="input-box_row_l">
                        <div class="input-box_input input-field-required input-slider-value required-ok">
                            <div class="input-field-wrap">
                                <span>$</span>
                                <input type="text" class="range-cpc input-field cpc-bid" name="cpc" required>
                            </div>
                            <span class="input-field-status "></span>
                        </div>
                    </div>
                    <div class="input-box_row_r">
                        <div class="input-box_slider">
                            <div class="input-slider_line">
                                <input type="text" class="input-slider" name="cpc-range-slider" data-min="0" data-max="0" data-current="0">
                            </div>
                        </div>
                    </div>
                </div><!--/.input-box_slider-->
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="input-box cpc-bid-fixed-ajax" @if($bid_type != 'fixed') style="display: none" @endif>
            <div class="input-box_l">
                <div class="input-box_title">
                    <span>CPC Bid</span>
                </div>
                <div class="input-box_row">
                    <div class="input-box_row_l">
                        <div class="input-box_input input-field-required input-slider-value required-ok">
                            <div class="input-field-wrap">
                                <span>$</span>
                                <input type="text" class="fixed-cpc input-field cpc-bid" value="{{$campaign->cpc}}" name="cpc" required>
                            </div>
                            <span class="input-field-status "></span>
                        </div>
                    </div>
                </div><!--/.input-box_slider-->
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="input-box">
            <div class="input-box_l">
                <div class="input-box_title">
                    <span>Start date</span>
                </div>
                <div class="input-box_row">
                    <div class="input-box_row_l">
                        <div class="input-box_input input-date-range">
                            <input type="text" class="datepicker-choose" name="date" value="{{$campaign->modified_date()}}">
                            <i class="icon-date"></i>
                        </div>
                    </div>
                    <div class="input-box_row_r">
                        <div class="text">
                            <p>Your campaign will start on <br><span class="campaign-date-js">{{$campaign->modified_full_date()}}</span>.</p>
                        </div>
                    </div>
                </div><!--/.input-box_slider-->
            </div><!--/.input-box_l-->
            <div class="input-box_r">
                <div class="text">
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                </div>
            </div><!--/.input-box_r-->
        </div><!--/.input-box-->
        <div class="input-box_btns centered margin-32px_top">
            <button class="btn btn-blue btn-icon btn-add-campaign"><i class="icon-edit-white"></i><span>Edit campaign</span></button>
        </div>
    </form>
</div><!--/.mainbar-main-->
@endsection