@extends('members.layouts.base')

@section('sidebar')
    @include('members.layouts.left_sidebar')
@endsection

@section('content')
    <div class="main-content lesson">
        <div class="main-content-container">
            <div class="title-block">
                <div class="title-block-ico-wrap">
                    <img src="{!! asset('assets/img/test-ico.svg') !!}" alt="">
                </div>
                <div class="title-block-right">
                    <div class="title-block-title">Тест: Что такое Employer Branding</div>
                    <div class="work-status">
                        <i>
                            <img src="{!! asset('assets/img/icons8-checkmark-26.png') !!}" alt="">
                        </i>
                        Тест пройден
                    </div>
                    <div class="status-info">
                        Правильных ответов - 4 / 6 <br>( +4 балла )
                    </div>
                    <div class="title-block-subtitle">
                        <span class="deadline-attention">!</span>
                        Выполнить до
                        06.02.2019
                    </div>
                    <!--breadcrumbs-->
                    @include('members.layouts.breadcrumbs')
                </div>
            </div>
            <div class="white-block test-description">
                <div class="white-block-container">
                    <div class="white-block-text">
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">1</div>
                            <div class="big-ico-block-text">
                                <p>на выполнение теста у вас есть 15 минут</p>
                            </div>
                        </div>
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">2</div>
                            <div class="big-ico-block-text">
                                <p>за каждый правильный ответ вы получите 1 балл</p>
                            </div>
                        </div>
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">3</div>
                            <div class="big-ico-block-text">
                                <p>всего за этот тест вы можете набрать 6 баллов</p>
                            </div>
                        </div>
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">4</div>
                            <div class="big-ico-block-text">
                                <p>некоторые вопросы предполагают несколько правильных ответов</p>
                            </div>
                        </div>
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">5</div>
                            <div class="big-ico-block-text">
                                <p>будьте внимательны — вы не получите баллы за тест, если пройдете его позже
                                    дедлайна</p>
                            </div>
                        </div>
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">6</div>
                            <div class="big-ico-block-text">
                                <p>вы сможете пройти тест повторно, но баллы засчитываются только за первое
                                    прохождение</p>
                            </div>
                        </div>
                    </div>
                    <div class="white-block-text-control-block">
                        <a href="{{ asset('course/'. request('c_id') .'/test/start/'. request('t_id') .'') }}" class="btn-transparent">Начать заново</a>
                        <a href="/" class="btn-transparent">Посмотреть ответы </a>
                        <a href="/" class="btn-transparent blue-button">Следующий урок</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
