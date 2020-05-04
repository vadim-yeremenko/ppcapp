@extends('layouts.pages')

@section('content')

    <div class="title-underlined margin-24px_top padding-16px_left">
        <h2>Contact</h2>
    </div>

    <div class="mainbar-main">
        <div class="contact-page">
            <div class="contact-page_left">
                <form action="#">
                    <div class="input-box input-box_no-text">
                        <div class="input-box_l">
                            <div class="input-box_title">
                                <span>Subject</span>
                            </div>
                            <div class="input-box_input">
                                <input type="text" class="input-field" placeholder="Please insert subject..." name="contact_subject">
                            </div>
                        </div><!--/.input-box_l-->
                    </div><!--/.input-box-->
                    <div class="input-box input-box_no-text">
                        <div class="input-box_l">
                            <div class="input-box_title">
                                <span>Message</span>
                            </div>
                            <div class="input-box_input">
                                <textarea class="input-field" name="contact_message" placeholder="Your message goes here…"></textarea>
                            </div>
                        </div><!--/.input-box_l-->
                    </div><!--/.input-box-->
                    <div class="input-box_btns centered margin-32px_top">
                        <button class="btn btn-icon btn-blue"><i class="icon-email"></i><span>Send message</span></button>
                    </div>
                </form>
            </div><!--/.contact-page_left-->
            <div class="contact-page_right">
                <div class="text">
                    <h3>CPC App Ltd.</h3>
                    <p>Ridiculus Nibh Sem  <br>Etiam porta sem malesuada magna mollis</p>
                    <p>Malesuada Commodo, Euismod</p>
                    <p>+00 123 456 789</p>
                    <a href="mailto:mail@domain.com" class="padding-8px_top">mail@domain.com</a>
                </div>

            </div><!--/.contact-page_right-->
        </div><!--/.contact-page-->
    </div><!--/.mainbar-main-->

@endsection