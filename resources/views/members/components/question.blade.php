<div class="progress-block-container">
    @isset($prev_question)
        <div class="test-back-link" data-value="{{ $prev_question }}">
            Назад
        </div>
    @endisset
    <div class="test-progress-block">
        @foreach($test->questions as $quest)
            <div data-value="{{ $quest->id }}"
                 class="@if(isset($quest->replied)){{ 'test-progress-item-danger' }} }} @elseif($quest->sort == 1) {{'test-progress-item-active'}} @endif test-progress-item"></div>
        @endforeach
    </div>
</div>
<div class="question-wrap">
    <div class="question-block-container">
        <div class="white-block-container">
            <div class="question-number">Вопрос 1</div>
            <div class="strong-text">{{ $question->title }}
            </div>
            <div class="test-answers">
                <form action="{{ asset('/course/'. request('c_id') .'/test/getQuestion/'. request('t_id') .'') }}" method="POST" id="question-form">
                    @csrf
                    @if(!isset($question->replied))
                        @foreach($question->answers as $answer)
                            @if($question->type == 0)
                                <div class="test-answer">
                                    <div class="checkbox">
                                        <input type="checkbox" id="form_answer{{ $loop->index }}"
                                               name="answers[{{ $loop->index }}]"
                                                class="styled" value="{{ $answer->id }}">
                                        <label for="form_answer{{ $loop->index }}">{{ $answer->title }}</label>
                                    </div>
                                </div>
                            @elseif($question->type == 1)
                                <div class="test-answer">
                                    <div class="radio">
                                        <input type="radio" id="form_answer{{ $loop->index }}"
                                               name="answer"
                                                class="styled" value="{{ $answer->id }}">
                                        <label for="form_answer{{ $loop->index }}">{{ $answer->title }}</label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden" name="current_question_id" value="{{ $question->id }}">
                    @else
                        @foreach($question->answers as $answer)
                            @if($question->type == 0)
                                <div class="fake-test-answer">
                                    <div class="fake_checkbox">
                                        <span class="form_answer @isset($answer->checked) {{ 'checked' }} @endisset">{{ $answer->title }}</span>
                                    </div>
                                </div>
                            @elseif($question->type == 1)
                                <div class="fake-test-answer">
                                    <div class="fake_radio">
                                        <span class="form_answer @isset($answer->checked) {{ 'checked' }} @endisset">{{ $answer->title }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden" name="current_question_id" value="{{ $next_question }}">
                    @endif
                    @if(isset($next_question))
                        <input type="hidden" name="next_question_id" value="{{ $next_question }}">
                        <button class="form-submit-button">Дальше</button>
                    @else
                        <button class="form-submit-button">Завершить тест</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function getQuestion() {
        let testAnswers = document.querySelector('.test-answers');
        let csrf = document.head.querySelector('meta[name="csrf-token"]').content;
        if (testAnswers) {
            let form = testAnswers.querySelector('#question-form');
            if (form) {
                let t_pr_itm = document.querySelector('.test-progress-item');

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (document.querySelectorAll('input[type="checkbox"]:checked').length >= 1 || document.querySelectorAll('input[type="radio"]:checked').length >= 1 || document.querySelectorAll('input[type="checkbox"]').length == 0 || document.querySelectorAll('input[type="radio"]').length ==0) {
                        var formData = new FormData(form)
                        axios({
                            method: form.method,
                            url: form.action,
                            data: formData,
                        }).then(function (response) {
                                if (response.data.url) {
                                    window.location.href = response.data.url;
                                } else {
                                    document.querySelector('#question').innerHTML = response.data;
                                    getQuestion();
                                    step_back();
                                }
                            }
                        )
                            .catch(function (errors) {
                                console.log(errors);
                            });
                    }
                })
            }
        }
    };
    function step_back() {
        let prevQuestion = document.querySelector('.test-back-link');
        if (prevQuestion) {
            prevQuestion.addEventListener('click', function () {
                let form = document.querySelector('#question-form');
                if (form) {
                    let question_id = prevQuestion.getAttribute('data-value');
                    axios({
                        method: form.method,
                        url: form.action,
                        data: { prev_question_id : question_id },
                    }).then(function (response) {
                            document.querySelector('#question').innerHTML = response.data;
                            step_back();
                            getQuestion();
                        }
                    )
                        .catch(function (errors) {
                            console.log(errors);
                        });
                }
            });
        }
    }
    getQuestion();
    step_back();
</script>