@extends('members.layouts.base')

@section('sidebar')
    @include('members.layouts.left_sidebar')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-container">
            <div class="nw_course-box">
                <div class="nw_course__box-header">
                    <div class="nw_course-owner">
                        <div class="nw_owner-ava">
                            <a href="{{route('profile')}}">
                                <img  src="{{ $course->trainer->avatar }}"   alt="">
                            </a>
                        </div>
                        <div class="nw__owner-content">
                            <div class="nw__owner-title">{{ $course->title }}</div>
                            <div class="nw__owner-name">
                                <a href="" class="text-muted" target="_blank">{{ $course->trainer->name }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="nw__shedule">
                        <span class="nw__shedule-date text-muted">{{ $course->lessons->count() }} занятий</span>
                    </div>
                </div>
                <div class="nw__box">
                    <div class="nw__box-content-box">
                        <div class="nw__box-content-item">
                            @lang('courses.course_points')
                            <span class="green">161</span>
                            <span class="black">/ 200</span>
                        </div>
                        <div class="nw__box-content-item">
                            @lang('courses.passing_score')
                            <span class="black">160</span>
                        </div>
                    </div>
                </div>
                <div class="nw__box-progress">
                    <div class="nw__box-progress-header">
                        <div class="nw__box-progress-header_title">@lang('courses.my_progress')</div>
                        <div class="nw__box-progress-content">
                            <div class="tab-pane">
                                <div class="short-statistic">
                                    <div class="diagram">
                                        <div class="value">
                                            161
                                            <span class="text-muted">@lang('courses.point')</span>
                                        </div>
                                        <canvas id="myCanvas" data-green="26" data-silver="35" data-yellow="44"
                                                width="120" height="120"></canvas>
                                    </div>
                                    <div class="diagram-footer">
                                        <div class="title">@lang('courses.stat')</div>
                                        <div class="description">@lang('courses.call_point')</div>
                                    </div>
                                </div>
                                <div class="full-statistic">
                                    <div class="item yellow">
                                        <div class="title">@lang('courses.home_tasks')</div>
                                        <div class="value done">124</div>
                                        <div class="progress-items list">
                                            @foreach($course->lessons as $lesson)
                                                <a href="{{ asset('course/'. $course->id .'/homework/show/'. $lesson->tasks[0]->id .'') }}" class="progress-item active">
                                                    <div class="custom" id="">
                                                        <div class="progress-tooltip">
                                                            <div class="title">
                                                                {{ $lesson->tasks[0]->description }}
                                                            </div>
                                                            <div class="description">
                                                                @lang('courses.go_home_tasks')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="item green">
                                        <div class="title">@lang('courses.tests')</div>
                                        <div class="value done">37</div>
                                        <div class="progress-items list">
                                            @foreach($course->lessons as $lesson)
                                                <a href="{{ asset('course/'. $course->id .'/test/show/'. $lesson->tests[0]->id .'') }}" class="progress-item active">
                                                    <div class="custom" id="">
                                                        <div class="progress-tooltip">
                                                            <div class="title">
                                                                {{ $lesson->tests[0]->title }}
                                                            </div>
                                                            <div class="description">
                                                                @lang('courses.go_test')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
