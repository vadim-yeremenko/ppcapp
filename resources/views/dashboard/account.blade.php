@extends('layouts.dashboard')

@section('content')
    <div class="title-underlined margin-24px_top">
        <h2>Account</h2>
    </div>

    <div class="mainbar-main">
        <form action="{{route('account-edit')}}" id="account-form" enctype="multipart/form-data" method="PUT">
            {{ csrf_field() }}
            <div class="account">
                <div class="input-box input-box-account">
                    <div class="input-box_l">
                        <div class="input-box_wrap">
                            <div class="input-box_title">
                                <span>Account Details</span>
                            </div>
                            <div class="form-item left-label">
                                <label for="account_email">Email:</label>
                                <div class="input-box_input input-field-required">
                                    <input type="email" class="input-field" placeholder="Please insert your email..." id="account_email" name="email" value="{{$userinfo->email}}" required>
                                    <span class="input-field-status"></span>
                                </div>
                                <button class="btn-edit edit-account-btn" id="edit_email"><span>Edit</span> <i class="icon-edit"></i></button>
                            </div>
                        </div><!--/.input-box_wrap-->
                        <div class="input-box_wrap">
                            <div class="form-item left-label">
                                <label for="account_name">Name:</label>
                                <div class="input-box_input input-field-required">
                                    <input type="email" class="input-field" placeholder="Please insert your name..." id="account_name" name="name" value="{{$userinfo->name}}" required>
                                    <span class="input-field-status"></span>
                                </div>
                                <button class="btn-edit edit-account-btn" id="edit_name"><span>Edit</span> <i class="icon-edit"></i></button>
                            </div>
                        </div><!--/.input-box_wrap-->
                        <div class="input-box_wrap">
                            <div class="form-item left-label">
                                <label for="company_name">Company name:</label>
                                <div class="input-box_input input-field-required">
                                    <input type="text" class="input-field" placeholder="Please insert your company name..." id="organization" value="{{$userinfo->organization}}"  name="organization" required>
                                    <span class="input-field-status"></span>
                                </div>
                                <button class="btn-edit edit-account-btn" id="edit_organization"><span>Edit</span> <i class="icon-edit"></i></button>
                            </div>
                        </div><!--/.input-box_wrap-->
                        <div class="input-box_wrap">
                            <div class="form-item left-label">
                                <label for="company_name">Role in company:</label>
                                <div class="input-box_input input-field-required">
                                    <input type="text" class="input-field" placeholder="Please insert your company role..." id="role" value="{{$userinfo->role}}"  name="role" required>
                                    <span class="input-field-status"></span>
                                </div>
                                <button class="btn-edit edit-account-btn" id="edit_organization_role"><span>Edit</span> <i class="icon-edit"></i></button>
                            </div>
                        </div><!--/.input-box_wrap-->
                        <div class="input-box_wrap">
                            <div class="form-item left-label">
                                <label for="account_address">Address:</label>
                                <div class="input-box_input input-field-required input-box_textarea">
                                    <textarea type="text" class="input-field" placeholder="Please insert your address..." id="account_address" name="address" required>{{$userinfo->address}}</textarea>
                                    <span class="input-field-status"></span>
                                </div>
                                <button class="btn-edit edit-account-btn" id="edit_address"><span>Edit</span> <i class="icon-edit"></i></button>
                            </div>
                        </div><!--/.input-box_wrap-->
                        <div class="input-box_wrap input-box_img">
                            <div class="form-item left-label">
                                <label for="account_address">Photo:</label>
                                <div class="input-box_input input-field-required account-avatar">
                                    <input type="file" class="avatar-field input-field" name="avatar" id="avatar-image" accept="image/x-png,image/gif,image/jpeg" >
                                    <div class="img">
                                        @if(empty(Auth::user()->avatar))
                                            <img src="{{url('img/avatar-placeholder.png')}}" class="avatar-field-img" alt="{{ Auth::user()->name }}">
                                        @else
                                            <img src="{{ Auth::user()->avatar }}" class="avatar-field-img"  alt="{{ Auth::user()->name }}">
                                        @endif
                                    </div>
                                    <span class="input-field-status"></span>
                                </div>
                                <div class="input-box_btns">
                                    <a href="#" class="btn-edit btn-avatar-upload"><span>Choose</span> <i class="icon-edit"></i></a>
                                    <br>
                                    <a href="#" class="btn-edit edit-avatar-btn"><span>Upload</span> <i class="icon-upload"></i></a>
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
                <div class="input-box input-box-account">
                    <div class="input-box_l">
                        <div class="input-box_wrap">
                            <div class="input-box_title">
                                <span>Password</span>
                            </div>
                            <div class="form-item left-label">
                                <label for="account_password">Password:</label>
                                <div class="input-box_input input-field-required">
                                    <input type="password" class="input-field" placeholder="Please insert your email..." id="account_password" name="account_password" required>
                                    <span class="input-field-status"></span>
                                </div>
                            </div>
                            <div class="input-box_btns pl-120">
                                <button class="btn btn-blue btn-icon btn-password-check edit-account-btn"><i class="icon-edit-white"></i><span>Update password</span></button>
                            </div>
                        </div><!--/.input-box_wrap-->
                    </div><!--/.input-box_l-->
                    <div class="input-box_r">
                        <div class="text">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
                        </div>
                    </div><!--/.input-box_r-->
                </div><!--/.input-box-->
            </div>
            <div class="campaigns-list_footer margin-32px_top">
{{--                <a href="#" class="btn btn-blue btn-icon"><i class="icon-check-white"></i><span>Confirm changes</span></a>--}}
                <a href="{{route('dashboard')}}" class="btn btn-bordered btn-icon margin-24px_left"><i class="icon-close"></i><span>Cancel</span></a>
            </div>
        </form>
    </div><!--/.mainbar-main-->
@endsection