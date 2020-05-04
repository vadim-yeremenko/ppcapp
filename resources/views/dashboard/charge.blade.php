@extends('layouts.dashboard')

@section('content')
    <div class="mainbar-header dashboard-header dashboard-header-back">
        <a href="#"><span>Account charge</span></a>
    </div>

    <div class="mainbar-main">
        <div class="flex-row flex-between mobile-flex-column">
            <div class="white-box width-536px">
                <div class="white-box_title">
                    <span>AMOUNT</span>
                </div>
                <div class="white-box-body">
                    <span class="text-bold">How much would you like to charge your account with?</span>
                    <div class="amount-charge-input">
                        <span>$</span>
                        <input type="number" class="money-mask" value="" placeholder="0.0" step="0.2">
                    </div>
                </div>
            </div><!--/.white-box-->
            <div class="white-box width-536px">
                <div class="white-box_title">
                    <span>Charge type</span>
                </div>
                <div class="white-box-body">
                    <span class="text-bold">How would you like to transfer funds?</span>
                    <div class="type-charge-input">
{{--                        <button class="btn btn-bordered btn-charge" name="paypal" value="paypal">Paypal</button>--}}
                        <button class="btn btn-bordered btn-charge" name="credit_card" value="credit_card">Credit Card</button>
                        <button class="btn btn-bordered btn-charge" name="wire_transfer" value="wire_transfer">Wire transfer</button>
                    </div>
                </div>
            </div><!--/.white-box-->
        </div>

        <div class="charge-footer">
            <span>Please select  „<b>Charge Type</b>” to continue.</span>
        </div>
        <div class="charge-form margin-32px_top" id="charge-card">
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Credit Card number</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="card-number input-field" placeholder="Please insert your Credit Card number" name="campaign_url" value="" required>
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
                        <span>Card holder name</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="input-field" placeholder="Please insert your Card holder name" name="campaign_url" value="Commodo Ridiculus" required>
                        <span class="input-field-status"></span>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="flex-row flex-between flex-align-top margin-32px_top">
                <div class="input-box input-box-notext width-536px">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Exp. date</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <input type="text" class="card-date input-field" placeholder="Please insert your Card exp date" name="campaign_url" value="Commodo Ridiculus" required>
                            <span class="input-field-status"></span>
                        </div>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->
                <div class="input-box input-box-notext width-536px">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>CVV Code</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <input type="password" class="card-cvv input-field" placeholder="Please insert your CVV Code" name="campaign_url" value="Commodo Ridiculus" required>
                            <span class="input-field-status"></span>
                        </div>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->
            </div>
            <div class="buttons-box margin-32px_top">
                <a href="#" class="btn btn-blue btn-icon"><i class="icon-check-white"></i> <span>Proceed</span></a>
                <a href="#" class="btn btn-bordered btn-icon margin-24px_left"><i class="icon-close"></i> <span>Cancel</span></a>
            </div><!--/.buttons-box-->
        </div>
        <div class="charge-form" id="charge-paypal">
            <div class="buttons-box margin-32px_top">
                <a href="#" class="btn btn-blue btn-icon"><i class="icon-check-white"></i> <span>Proceed</span></a>
                <a href="#" class="btn btn-bordered btn-icon margin-24px_left"><i class="icon-close"></i> <span>Cancel</span></a>
            </div><!--/.buttons-box-->
        </div><!--/.charge-form paypal-->
        <div class="charge-form" id="charge-wire">
            <div class="bank-details">
                <div class="bank-details_l">
                    <div class="bank-details_title">
                        <span>Bank Details</span>
                    </div>
                    <div class="bank-details_row">
                        <div class="title">Payee:</div>
                        <div class="value">CPC App Ltd.</div>
                    </div>
                    <div class="bank-details_row">
                        <div class="title">Running campaigns:</div>
                        <div class="value">1234 5678 9012 3456</div>
                    </div>
                    <div class="bank-details_row">
                        <div class="title">Bank:</div>
                        <div class="value">Chase</div>
                    </div>
                </div>
                <div class="bank-details_r">
                    <div class="bank-details_important">
                        <div class="bank-details_text">
                            <span><b>IMPORTANT:</b></span>
                            <p>You must include <b>P123456789</b> in your bank transfer’s payment description field</p>
                        </div>
                    </div>
                </div>
            </div><!--/.bank-details-->
            <div class="buttons-box margin-32px_top">
                <a href="balance-success.html" class="btn btn-blue btn-icon"><i class="icon-check-white"></i> <span>Confirm</span></a>
                <a href="#" class="btn btn-bordered btn-icon margin-24px_left"><i class="icon-close"></i> <span>Cancel</span></a>
            </div><!--/.buttons-box-->
        </div>
    </div><!--/.mainbar-main-->
@endsection