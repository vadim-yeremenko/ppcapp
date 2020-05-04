@extends('layouts.admin')

@section('content')

    <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
        <a href="{{route('edit_pages')}}"><span>Edit or add FAQ</span></a>
    </div>

    <div class="mainbar-main">
        <div class="edit-content">
            <form action="{{route('edit_faq_ajax')}}" method="POST" id="faq-edit-title">
                <div class="input-box input-box-full">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Page title</span>
                        </div>
                        <div class="input-box_input input-field-required">
                            <input type="text" class="input-field" placeholder="Please insert page title..." name="title" value="{{$pagetitle}}">
                        </div>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->
                <div class="ta-right">
                    <button class="btn btn-blue margin-24px_top"> <span>Save changes</span></button>
                </div>
            </form>
            @foreach($faq_list as $id=>$faq)
                <div class="input-box input-box-full input-box-faq" data-faq="{{$id}}">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Edit FAQ item</span>
                        </div>
                        <form action="{{route('edit_faq_ajax')}}" class="faq-edit" data-id="{{$id}}">
                            <input type="hidden" name="faq" value="{{$id}}">
                            <div class="input-box_input">
                                <input type="text" class="input-field" placeholder="FAQ Question" name="question" value="{{$faq->question}}">
                            </div>
                            <div class="input-box_input margin-16px_top">
                                <textarea class="input-field" placeholder="FAQ Answer" name="answer">{{$faq->answer}}</textarea>
                            </div>
                            <div class="input-box_btn margin-16px_top ta-right">
                                <button type="submit" class="btn btn-blue"><span>Save</span></button>
                                <a class="btn btn-bordered faq-delete" data-action="delete" data-id="{{$id}}"><span>Remove</span></a>
                            </div>
                        </form>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->
            @endforeach

            <div id="input-box-faq-more">
                <div class="input-box input-box-full input-box-faq">
                    <div class="input-box_l">
                        <div class="input-box_title">
                            <span>Add new FAQ item</span>
                        </div>
                        <form action="{{route('edit_faq_ajax')}}" id="faq-add">
                            <input type="hidden" name="add" value="1">
                            <div class="input-box_input">
                                <input type="text" class="input-field" placeholder="FAQ Question" name="question">
                            </div>
                            <div class="input-box_input margin-16px_top">
                                <textarea class="input-field" placeholder="FAQ Answer" name="answer"></textarea>
                            </div>
                            <div class="input-box_btn margin-16px_top ta-right">
                                <button type="submit" class="btn btn-blue"><span>Save</span></button>
{{--                                <button class="btn btn-cancel faq-remove"><span>Remove</span></button>--}}
                            </div>
                        </form>
                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->
            </div>
{{--            <div class="input-box-faq-add"></div>--}}
{{--            <div class="add-more-faq margin-32px_top ta-right">--}}
{{--                <button type="submit" class="btn btn-bordered add-faq-item margin-24px_left"><span>Add more</span></button>--}}
{{--            </div>--}}
        </div>

    </div>

@endsection