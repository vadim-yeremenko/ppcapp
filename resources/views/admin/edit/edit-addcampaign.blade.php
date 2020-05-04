@extends('layouts.admin')

@section('content')

    <div class="dashboard-header mainbar-header margin-32px_bottom dashboard-header-back">
        <a href="{{route('edit_pages')}}"><span>Edit Terms of condition</span></a>
    </div>
{{----}}
    <div class="text editable-text">
        <div class="editable-field">
            <textarea id="text" name="campaign_name" cols="30" rows="10"></textarea>
            <a href="#" class="btn btn-blue btn-icon margin-16px_top"><i class="icon-edit-white "></i><span>Save changes</span></a>
        </div>
        <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna.</p>
    </div>
{{----}}
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