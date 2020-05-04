<div class="mainbar-header dashboard-header dashboard-header-back">
    <a href="{{route('account')}}"><span>Password change</span></a>
</div>
<div class="mainbar-main">
    <div class="account">
        <form action="{{route('account-edit')}}" id="account-password-form" method="POST">
            {{ csrf_field() }}
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_wrap">
                        <div class="input-box_title">
                            <span>Old Password</span>
                        </div>
                        <div class="form-item left-label">
                            <label for="account_email">Old password:</label>
                            <div class="input-box_input input-field-required">
                                <input type="password" class="input-field" placeholder="Please insert your old password..." id="account_old_password" name="account_old_password" required>
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                    </div><!--/.input-box_wrap-->
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_wrap">
                        <div class="input-box_title">
                            <span>New password:</span>
                        </div>
                        <div class="form-item left-label">
                            <label for="account_re_password">Type password:</label>
                            <div class="input-box_input input-field-required">
                                <input type="password" class="input-field" placeholder="Please insert your new password..." id="account_password" name="account_password" required>
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                    </div><!--/.input-box_wrap-->
                    <div class="input-box_wrap">
                        <div class="form-item left-label">
                            <label for="account_password">Retype password:</label>
                            <div class="input-box_input input-field-required">
                                <input type="password" class="input-field" placeholder="Please confirm your new password..." id="account_re_password" name="account_re_password" required>
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                    </div><!--/.input-box_wrap-->
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
        </form>
    </div>
    <div class="campaigns-list_footer margin-32px_top">
        <button class="btn btn-blue btn-icon btn-change-password"><i class="icon-check-white"></i><span>Confirm changes</span></button>
        <a href="{{route('account-edit')}}" class="btn btn-bordered btn-icon margin-24px_left"><i class="icon-close"></i><span>Cancel</span></a>
    </div>
</div><!--/.mainbar-main-->