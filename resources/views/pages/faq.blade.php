@extends('layouts.pages')

@section('content')
    <div class="title-underlined margin-24px_top padding-16px_left">
        <h2>FAQ</h2>
    </div>

    <div class="mainbar-main">
        <div class="faq-search-box">
            <form action="{{route('faq_search')}}" class="faq-search-form" method="POST" id="faq_search">
                <div class="title">
                    <span>Search FAQ</span>
                </div>
                <div class="input-field input-field-icon">
                    <input type="search" name="search" placeholder="Search request">
                    <button type="submit" class="btn-search"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
        <div class="faq-box text-boxes-row margin-48px_top" id="faq-list">

            @foreach(array_chunk($faq, 2) as $value)
                <div class="faq_column">
                    @foreach($value as $item)
                        <div class="text-box">
                            <div class="text-box_head">
                                <span>{{$item['question']}}</span>
                            </div>
                            <div class="text-box_body">
                                <p>{{$item['answer']}}</p>
                            </div>
                            <div class="text-box_footer">
                                <a href="#" class="btn-read-more"><span>Read more</span><i class="icon-arrow-read"></i></a>
                            </div>
                        </div><!--/.text-box-->
                    @endforeach
                </div>
            @endforeach

{{--        <div class="buttons-box margin-32px_top">--}}
{{--            <a href="#" class="btn btn-icon btn-bordered"><i class="icon icon-arrow-down"></i><span>Show more</span></a>--}}
{{--        </div>--}}
    </div><!--/.mainbar-main-->
@endsection