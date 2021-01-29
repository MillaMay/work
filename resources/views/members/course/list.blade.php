@extends('members.layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="clear"></div>
        <h1>Мои курсы</h1>
        <div class="card shadow">
            @isset($courses)
                @foreach($courses as $course)
                    <div class="card-header font-weight-bolder">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                 aria-valuemin="0" aria-valuemax="100">75%
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-between course-description">
                        <div class="d-flex">
                            <div class="photo">
                                <img src="{{ $course->logo }}" alt="">
                            </div>
                            <div>
                                <h2 class="text-uppercase">{{ $course->title }}</h2>
                                <p class="text-muted">{{ $course->description }}</p>
                                <p class="text-muted">{{ $course->trainer->name }}</p>
                                <a href="{{ asset('course/show/'. $course->id .'') }}" class="btn btn-info">Перейти</a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-around">
                            <div class="flex-container flex-column">
                                <div class="number-task">
                                    <div class="text-muted">Тестов: <span class="task-count">{{ $tests_count[$course->id] }}</span></div>
                                </div>
                                <div class="number-task">
                                    <div class="text-muted">Заданий: <span class="task-count">{{ $tasks_count[$course->id] }}</span></div>
                                </div>
                                <div class="number-score">
                                    <div class="text-muted">Баллов:<span class="text-dark"> 161 / 200 </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
@endsection


