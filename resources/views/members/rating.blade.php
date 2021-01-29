@extends('members.layouts.base')

@section('sidebar')
     @include('members.layouts.left_sidebar')
@endsection

@section('content')
    <div class="main-content lesson">
        <div class="main-content-container">
            <div class="course-head-wrapper">
                <div class="course-head">
                    <div class="avatar">
                        <img src="{{ asset($course->trainer->avatar) }}" alt="avatar">
                    </div>
                    <div class="title">{{ $course->title }}</div>
                    <div class="name">( поток 1, {{ $course->members->count() }} студентов )</div>
                </div>
                <div class="schedule">
                    <div class="description">8 занятий с 30 января по 25 февраля</div>
                </div>
            </div>
            <div class="sup-table-block">
                <div class="rating-title">Рейтинг успеваемости студентов</div>
                <div class="completed_tasks">Пройдено занятий: 8</div>
            </div>
            <br>
            <div class="white-block" style="margin-bottom: 15px;">
                <div class="tab-content">
                    <div class="tab-pane" id="teacher-tasks">
                        <div class="users-info">
                            <table class="student-table">
                                <thead>
                                <tr>
                                    <th class="place-column">Место</th>
                                    <th class="table-student-info"> студент</th>
                                    <th>
                                        Всего баллов
                                        <div class="max-results">
                                            Max
                                            200
                                        </div>
                                    </th>
                                    <th>
                                        За ДЗ
                                        <div class="max-results">
                                            Max
                                            152
                                        </div>
                                    </th>
                                    <th>
                                        За тесты
                                        <div class="max-results">
                                            Max
                                            48
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($course->members as $member)
                                    <tr class="@if($user_id == $member->id) active @endif">
                                        <td class="place-column">{{ $loop->index + 1 }}</td>
                                        <td class="table-student-info" data-id="">
                                            <a href="/" class="avatar">
                                                <img src="{{ $member->avatar }}"
                                                     alt="avatar">
                                            </a>
                                            <a href="/" class="username">
                                                <div>{{ $member->name }}</div>
                                            </a>
                                        </td>
                                        <td>196</td>
                                        <td>149</td>
                                        <td>47</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
