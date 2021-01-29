@extends('members.layouts.base')

@section('sidebar')
     @include('members.layouts.left_sidebar')
@endsection

@section('content')
    <div class="main-content lesson">
        <div class="main-content-container">
            <!--breadcrumbs-->
            @include('members.layouts.breadcrumbs')
            <div id="question">
                @include('members.components.question')
            </div>
        </div>
    </div>
    </div>
@endsection
