@extends('members.layouts.base')

@section('sidebar')
    @include('members.layouts.left_sidebar')
@endsection

@section('content')
    <div class="main-content lesson">
        <div class="main-content-container">
            <div class="white-block">
                <div class="main-media">
                    <div class="nw__lesson-video">
                        <div class="nw__video-header">{{ $lesson->title }}</div>
                        <div class="server-video">
                            <video poster="{!! asset('assets/img/poster.PNG') !!}" id="player" playsinline controls>
                                <source src="{{ asset($lesson->video) }}" type="video/mp4"/>
                                <!-- Captions are optional -->
                                <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en"
                                       default/>
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white-block">
                <div class="nw__materials-box">
                    <div class="nw__materials-box-title">Материалы для изучения</div>
                    <div class="nw__material-list">
                        @foreach($lesson->materials as $material)
                            <div class="nw__materials-item">
                                <div class="nw__materials-content">
                                    <a href="/" target="_blank" class="nw__materials-item-img">
                                        <img src="{{ asset($material->image) }}" alt="">
                                    </a>
                                    <div class="nw__materials-item-title">
                                        <a href="{{ asset($material->URL) }}" class=" material-media" target="_blank">{{ $material->title }}</a>
                                    </div>
                                    <div class="nw__materials-item-descr">
                                        {{ $material->description }}
                                    </div>
                                    <div class="nw__materials-item-actions">
                                        @if(!isset($material->memberMaterial) || !$material->memberMaterial->studied)
                                            <div class="nw__check-link check-in" data-value="{{ $material->id }}">Отметить</div>
                                            <div class="nw__checked-mark">
                                                <i>
                                                    <img src="{!! asset('assets/img/icons8-checkmark-26.png') !!}" alt="">
                                                </i>
                                                <span>Просмотрено</span>
                                            </div>
                                        @else
                                            <div class="nw__checked-mark checked">
                                                <i>
                                                    <img src="{!! asset('assets/img/icons8-checkmark-26.png') !!}" alt="">
                                                </i>
                                                <span>Просмотрено</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
