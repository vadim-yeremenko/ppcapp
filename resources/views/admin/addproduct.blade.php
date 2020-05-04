@extends('layouts.admin')

@section('content')
    <div id="content">
        <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
            <a href="{{route('admin-dashboard')}}"><span>Add product</span></a>
        </div>
        <div class="mainbar-main">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach

            <form enctype="multipart/form-data" method="POST" action="{{ route('add-product-form') }}">
                {{ csrf_field() }}
                <div class="input-box">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Product name</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <input type="text" class="input-field" placeholder="Please insert your name for product..." name="title">
                            <span class="input-field-status"></span>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="input-box" >
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Is it a subproduct?</span>
                        </div>
                        <div class="input-box_input input-box_input-radio input-field-required">
                            <label for="subproduct-yes" class="subproducts-radio">
                                <span>Yes</span>
                                <input type="radio" id="subproduct-yes" class="radio-btn" name="is_sub" value="yes">
                            </label>
                            <label for="subproduct-no" class="subproducts-radio active">
                                <span>No</span>
                                <input type="radio" id="subproduct-no" class="radio-btn" name="is_sub" value="no" checked>
                            </label>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="input-box input-box-sub" style="display: none">
                    <div class="input-box">
                        <div class="input-box_l">
                            <div class="input-box_title">
                                <span>Sub product</span>
                            </div>
                            <div class="input-box_input input-box_select">
                                <select name="parent_product" id="parent_product" class="select-styled" data-placeholder="Select sub product">
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
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

                <div class="input-box">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Product description</span>
                        </div>
                        <div class="input-box_input input-box_textarea input-field-required">
                            <textarea name="description" id="description" placeholder="Please add description for a new product…" class="input-field"></textarea>
                            <span class="input-field-status"></span>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="input-box" >
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Use fixed CPC Bid or range?</span>
                        </div>
                        <div class="input-box_input input-box_input-radio input-field-required">
                            <label for="cpc_type-singular" class="subproducts-radio bid-type-radio">
                                <span>Fixed</span>
                                <input type="radio" id="cpc_type-singular" class="radio-btn" name="cpc_type" value="singular">
                            </label>
                            <label for="cpc_type-range" class="subproducts-radio bid-type-radio active">
                                <span>Range</span>
                                <input type="radio" id="cpc_type-range" class="radio-btn" name="cpc_type" value="range" checked>
                            </label>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="input-box" id="cpc_range">
                    <div class="input-box_l input-box_flex">
                        <div class="col">
                            <div class="input-box_title">
                                <span>Minimal CPC Bid</span>
                            </div>
                            <div class="input-box_input input-field-required">
                                <input type="text" class="input-field cpc-bid" name="mincpc" placeholder="$0.00">
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-box_title">
                                <span>Maximal CPC Bid</span>
                            </div>
                            <div class="input-box_input input-field-required">
                                <input type="text" class="input-field cpc-bid" name="maxcpc" placeholder="$0.00">
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="input-box" id="cpc_singular" style="display: none;">
                    <div class="input-box_l">
                        <div class="col">
                            <div class="input-box_title">
                                <span>Fixed CPC Bid</span>
                            </div>
                            <div class="input-box_input input-field-required">
                                <input type="text" class="input-field cpc-bid" name="singlecpc" placeholder="$0.00">
                                <span class="input-field-status"></span>
                            </div>
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
                            <span>Product URL</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <input type="text" class="input-field" placeholder="Please insert URL for product..." name="url" required>
                            <span class="input-field-status"></span>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="input-box product-image-box">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Product Image</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <div class="form-item left-label">
                                <div class="input-box_input input-field-required account-avatar">
                                    <input type="file" name="image" class="avatar-field" id="product-image" accept="image/x-png,image/gif,image/jpeg" >
                                    <div class="img">
                                        <img src="/images/image-placeholder.png" class="avatar-field-img">
                                    </div>
                                    <span class="input-field-status"></span>
                                </div>
                                <div class="input-box_btns btns-row">
                                    <a href="#" class="btn-edit choose-img-btn"><span>Choose</span> <i class="icon-edit"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->

                <div class="margin-32px_top centered">
                    <button class="btn btn-blue btn-icon btn-add-product"><i class="icon-check-white"></i><span>Add new product</span></button>
                    <button class="btn btn-icon btn-bordered margin-24px_left" onclick="history.back()"><i class="icon-close"></i><span>Cancel</span></button>
                </div>
            </form>

        </div><!--/.mainbar-main-->
    </div>
@endsection