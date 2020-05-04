@extends('layouts.authorization')

@section('content')
    <div class="container">
        <div class="title-underlined">
            <h2>Create new account</h2>
        </div>
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Your email</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="email" class="input-field" placeholder="Please insert your email..."
                               name="email" required>
                        <span class="input-field-status"></span>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere
                            erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget
                            urna.</p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Your name</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="input-field" placeholder="Please insert your name…"
                               name="name" required>
                        <span class="input-field-status"></span>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere
                            erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget
                            urna.</p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Organization name</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="input-field"
                               placeholder="Please insert name of your organization…"
                               name="organization" required>
                        <span class="input-field-status"></span>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non
                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="input-box">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Your role</span>
                    </div>
                    <div class="input-box_input input-field-required">
                        <input type="text" class="input-field"
                               placeholder="Please state your role in organization…"
                               name="role" required>
                        <span class="input-field-status"></span>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non
                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="input-box input-box-passwords">
                <div class="input-box_l">
                    <div class="input-box_title">
                        <span>Password:</span>
                    </div>
                    <div class="input-box_input">
                        <div class="form-item left-label">
                            <label for="password">Type password:</label>
                            <div class="input-field-required">
                                <input type="password" class="input-field" name="password" id="password">
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                        <div class="form-item left-label">
                            <label for="password_confirmation">Retype password:</label>
                            <div class="input-field-required ">
                                <input type="password" class="input-field" name="password_confirmation"
                                       id="password_confirmation">
                                <span class="input-field-status"></span>
                            </div>
                        </div>
                    </div>
                </div><!--/.input-box_l-->
                <div class="input-box_r">
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non
                            commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
                    </div>
                </div><!--/.input-box_r-->
            </div><!--/.input-box-->
            <div class="buttons-box margin-32px_top margin-56px_bottom">
                <a href="#" class="btn btn-blue btn-icon btn-registration"><i class="icon-check-white"></i> <span>Request new account</span></a>
                <a href="#" class="btn btn-bordered btn-icon"><i class="icon-close"></i> <span>Cancel</span></a>
            </div><!--/.buttons-box-->
        </form>
    </div><!--/.container -->
@endsection
