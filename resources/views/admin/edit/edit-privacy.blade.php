@extends('layouts.admin')

@section('content')

    <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
        <a href="{{route('edit_pages')}}"><span>Edit Terms of condition</span></a>
    </div>

    <div class="mainbar-main">
        <div class="edit-content">
            <form action="#">

                <div class="input-box input-box-full">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Page title</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <input type="text" class="input-field" placeholder="Please insert your name for product..." name="title">
                            <span class="input-field-status"></span>
                        </div>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->

                <div class="input-box input-box-full">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Content</span>
                        </div>
                        <div id="froala-editor">

                        </div>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->

                <div class="ta-right">
                    <button class="btn btn-blue margin-24px_top"> <span>Save changes</span></button>
                </div>
            </form>
        </div>

    </div>

@endsection