@extends('members.layouts.base')

@section('sidebar')
    @include('members.layouts.left_sidebar')
@endsection

@section('content')
    <div class="main-content lesson">
        <div class="main-content-container">
            <div class="title-block">
                <div class="title-block-ico-wrap">
                    <img src="{!! asset('assets/img/title-ico-homework.svg') !!}" alt="">
                </div>
                <div class="title-block-right">
                    <div class="title-block-title">Домашнее задание: Что такое Employer Branding</div>
                </div>
                <div class="points">
                    <div class="points-title">баллов:</div>
                    <div class="points-value">
                        18
                        /
                        19
                    </div>
                </div>
            </div>
            <div class="create-brand">
                <div class="create-brand-container">
                    <div class="create-brand-text">
                        <div class="big-ico-block-item">
                            <div class="big-ico-block-ico">
                                <img src="{!! asset('assets/img/dqwdqw.png') !!}">
                            </div>
                            <div class="big-ico-block-text">
                                <p>Сделайте бренд-портрет для вашей компании.</p>
                                <p>Для выполнения домашнего задания воспользуйтесь <a href=""
                                                                                      target="_blank">шаблоном</a>.</p>
                            </div>
                        </div>
                        <p>Готовый документ прикрепите в pdf-формате в строке комментариев под домашним
                            заданием.</p>
                    </div>
                </div>
            </div>
            <div class="create-brand">
                <div class="create-brand-container">
                    <div class="create-brand-text">
                        <div class="big-ico-block-item" style="border: none;">
                            <div class="big-ico-block-ico question-item-photo-wrap">
                                <img src="{!! asset('assets/img/empty_profile.png') !!}">
                            </div>
                            <div class="question-item">
                                <div class="question-content">
                                    <div class="question-top">
                                        <div class="question-name">Ярослав Раца</div>
                                        <div class="date">01.02.2019</div>
                                        <a href="" target="_blank" class="join-file-button">
                                            Прикрепленный файл
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="create-brand">
                <div class="create-brand-container">
                    <div class="questions-answers-wrap">
                        <div class="question-with-answers">
                            <div class="mark-block-wrap">
                                <div class="mark-title">
                                    <div class="mark-title-text">Оценка домашнего задания</div>
                                    <div class="mark-title-points">Задание выполнено:
                                        18/19
                                    </div>
                                </div>
                                <div class="progress" style="height: 6px">
                                    <div class="progress-bar  bg-success" role="progressbar" style="width: 75%"
                                         aria-valuenow="75"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="question-item">
                                <div class="question-item-photo-wrap">
                                    <img src="{!! asset('assets/img/empty_profile.png') !!}">
                                </div>
                                <div class="question-content">
                                    <div class="question-top">
                                        <div class="question-name">Милена</div>
                                        <div class="date"></div>
                                    </div>
                                    <div class="question-text">
                                        <p>Ярослав, добрый день!</p>
                                        <p>Хороший анализ, четкое понимание.</p>
                                        <p>Чуть больше углубитесь в детали что вы предлагаете, как работодатель:</p>
                                        <p>рабочая среда - что именно?<br>
                                            Управленческий стиль - какой? что это дает сотрудникам?,и т.д.</p>
                                        <p>Посмотрите чуть детальней портрет продавцов - образование, интересы,
                                            мотивация, куда уходят</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homework-answer">
                <div class="question-block-wrap">
                    <div class="question-block">
                        <div class="question-block-main">
                            <form action="">
                                <textarea name="editor1"></textarea>
                                <button class="homework-answer-button">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
