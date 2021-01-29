<div class="sidebar d-flex flex-column justify-content-start">
    <div>
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <h2 class="text-warning mb-3">{{ $course->title }}</h2>
            </div>
            <div class="progress" style="height: 3px">
                <div class="progress-bar  bg-success" role="progressbar" style="width: 75%" aria-valuenow="75"
                     aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="text-dark">Прогресс:</span>
                    <span class="text-success font-weight-bold">160/200</span>
                </div>
                <a class="text-white text-rating" href="{{ asset('course/'. $course->id .'/rating/') }}">Рейтинг</a>
            </div>
        </div>
        <div class="accordion">
            @foreach($course->lessons as $lesson)
                <div class="accordion-item">
                    <div class="accordion-item_name">
                        <span class="circle__progress_bar">
                             <img src="{!! asset('assets/img/check-mark2.png') !!}" alt="">
                            <svg
                                data-percent="65"
                                class="progress-ring">
                            <circle
                                class="progress-ring__circle"
                                stroke="white"
                                stroke-width="2"
                                fill="transparent"
                                r="8"
                                cx="20"
                                cy="20"/>
                        </svg>
                        </span>
                        <span class="accordion-text">{{ $loop->index + 1 }}. {{ $lesson->title }}</span>
                        <span class="icon-play">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g fill="none" fill-rule="evenodd">
                                    <path fill="#FFF" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                                    <path fill="#31263E" d="M11 8L6 4v8z"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <span class="accordion__group-icon">
                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg"
                                 shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                 image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                 viewBox="0 0 1010933 1888375"><path
                                    d="M113954 1868840c-13023 13023-29302 19535-47209 19535s-34186-6512-47209-19535c-26047-26047-26047-68372 0-94419l830233-830233-830233-830233c-26047-26047-26047-68372 0-94419s68372-26047 94419 0l877442 877442c26047 26047 26047 68372 0 94419l-877442 877442-1 1z"></path></svg>
                        </span>
                    <div class="accordion-item_content">
                        <ul class="accordion-item_list">
                            <li class="accordion-item_list-item">
                                <a href="{{ asset('course/'. $course->id .'/lesson/show/'. $lesson->id .'') }}" class="accordion-item_list-link">Посмотрите
                                    занятие</a>
                            </li>
                            <li class="accordion-item_list-item">
                                <img src="{!! asset('assets/img/check-mark.png') !!}"
                                     class="accordion-item_list-item-passed" alt="">
                                <a href="{{ asset('course/'. $course->id .'/test/show/'. $lesson->tests[0]->id .'') }}" class="accordion-item_list-link">Пройдите тест</a>
                            </li>
                            <li class="accordion-item_list-item">
                                <img src="{!! asset('assets/img/check-mark.png') !!}"
                                     class="accordion-item_list-item-passed" alt="">
                                <a href="{{ asset('course/'. $course->id .'/homework/show/'. $lesson->tasks[0]->id .'') }}" class="accordion-item_list-link">Домашнее задание</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

