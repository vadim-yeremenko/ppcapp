@extends('layouts.admin')

@section('content')

    <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
        <a href="{{route('edit_pages')}}"><span>Edit Terms of condition</span></a>
    </div>

    <div class="mainbar-main">
        <div class="edit-content">
            <form action="#">
                <div id="froala-editor">

                </div>
                <div class="ta-right">
                    <button class="btn btn-blue margin-24px_top"> <span>Save changes</span></button>
                </div>
            </form>
        </div>

    </div>

@endsection