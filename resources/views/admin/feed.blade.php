@extends('layouts.admin')

@section('content')
    {{$feed}}
    <div class="mainbar-main admin-feed-page">
        <div class="admin-feed">
            <div class="admin-feed_dates">
                <span>06/30/19</span>
            </div>
            <div class="admin-feed_list">
                <div class="admin-feed-item admin-feed-balance">
                    <div class="admin-feed-item_icon">
                        <div class="icon">
                            <i class="icon-product"></i>
                        </div>
                    </div>
                    <div class="admin-feed-item_main">
                        <div class="title"><span><b>Ligula Sollicitudin</b></span></div>
                        <p>Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="buttons">
                            <a href="#" class="btn-small btn-small-icon"><span>View product</span> <i class="icon-arrow-right-c"></i></a>
                        </div>
                    </div>
                </div>
                <div class="admin-feed-item admin-feed-product">
                    <div class="admin-feed-item_icon">
                        <div class="avatar">
                            <img src="img/avatar-placeholder.png" alt="Avatar">
                        </div>
                    </div>
                    <div class="admin-feed-item_main">
                        <div class="title"><span>Abullah Sallah: <b>Egestas Lorem Condimentum Ullamcorper</b></span></div>
                        <p>Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="buttons">
                            <a href="#" class="btn-small btn-small-icon"><span>View user profile</span> <i class="icon-arrow-right-c"></i></a>
                        </div>
                    </div>
                </div>
                <div class="admin-feed-item admin-feed-user">
                    <div class="admin-feed-item_icon">
                        <div class="icon">
                            <i class="icon-balance"></i>
                        </div>
                    </div>
                    <div class="admin-feed-item_main">
                        <div class="title"><span><b>Ligula Sollicitudin</b></span></div>
                        <p>Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="buttons">
                            <a href="#" class="btn-small hover btn-small-icon"><span>Go to balance</span> <i class="icon-arrow-right-c"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!--/.mainbar-main-->
@endsection