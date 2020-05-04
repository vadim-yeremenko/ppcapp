@extends('layouts.admin')

@section('content')

    <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
        <a href="{{route('admin-dashboard')}}"><span>Edit pages</span></a>
    </div>
    <div class="mainbar-main">
        <div class="edit-content">
            <div class="toc">
                <div class="toc_body">
                    <ul>
                        <li><a href="{{route('edit_pages_faq')}}"><span>Edit FAQ page</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_sitemap')}}"><span>Edit Sitemap</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_security')}}"><span>Edit Security</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_terms')}}"><span>Edit Terms of condition</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_contact')}}"><span>Edit Contact</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_registration')}}"><span>Edit text on form for registration</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_product')}}"><span>Edit text on form for adding new product</span> <i class="icon-arrow-right-c"></i></a></li>
                        <li><a href="{{route('edit_pages_campaign')}}"><span>Edit text on form for adding new campaign</span> <i class="icon-arrow-right-c"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection