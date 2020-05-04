@extends('layouts.admin')

@section('content')

    <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
        <a href="{{route('edit_pages')}}"><span>Edit Sitemap</span></a>
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
                        <textarea name="content" id="editor">
                            <h3>Donec id elit non mi porta gravida at eget metus.</h3>
                            <p>Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit. Nulla vitae elit libero, a pharetra augue. Fusce dapibus, tellus ac.</p>
                            <h3>Cras mattis consectetur purus sit fermentum.</h3>
                            <p>Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum. Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Maecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus.</p>
                            <p>Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                            <h3>Fusce dapibus, tellus ac cursus commodo.</h3>
                            <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Maecenas faucibus mollis interdum. Sed posuere consectetur est at lobortis. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Maecenas faucibus mollis interdum.</p>
                            <p>Etiam porta sem malesuada magna mollis euismod. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui.</p>
                            <h3>Aenean eu leo quam.</h3>
                            <p>Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum. Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Maecenas faucibus mollis interdum. Donec id elit non mi porta gravida at eget metus.
                            <p>Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                            <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Maecenas faucibus mollis interdum. Sed posuere consectetur est at lobortis. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Maecenas faucibus mollis interdum.</p>
                            <p>Etiam porta sem malesuada magna mollis euismod. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec sed odio dui.</p>
                        </textarea>

                    </div><!--/.input-box_l-->
                </div><!--/.input-box-->

                <div class="ta-right">
                    <button class="btn btn-blue margin-24px_top"> <span>Save changes</span></button>
                </div>
            </form>
        </div>

    </div>

@endsection