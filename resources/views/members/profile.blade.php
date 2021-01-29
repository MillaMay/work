@extends('members.layouts.base')

@section('sidebar')
    {{-- @include('members.layouts.left_sidebar')--}}
@endsection

@section('content')
    <div class="main-content lesson">
        <div class="main-content-container wide">
            <div class="transparent-block">
                <!--breadcrumbs-->
                @include('members.layouts.breadcrumbs')
                <br>
            </div>
            <div class="profile-block">
                <div class="profile-block-title">Личные данные</div>
                <div class="profile-block-container">
                    <div class="profile-form">
                        <form action="/" name="user_data" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="one-avatar">
                                        <img src="https://l-a-b-a.com/uploads/teacher/166/1/small5d41935720881.jpg"
                                             alt="">
                                    </div>
                                    <div class="avatar-change">
                                        <label for="user_avatar-file" class="user_avatar-label">Заменить аватарку</label>
                                        <input type="file" id="user_avatar-file" hidden>
                                        <img src="{!! asset('assets/img/check-mark2.png') !!}" class="selected_avatar"  alt="">
                                    </div>
                                </div>
                                <div class="col-sm-6  gender-block">
                                    <div class="form-label">Пол</div>
                                    <div class="sex">
                                        <div class="radio">
                                            <div class="user-sex">
                                                <input type="radio" id="user_sex_1" required="required" name="user_sex"
                                                       value="1">
                                                <label for="user_sex_1">Мужской</label>
                                                <input type="radio" id="user_sex_0" required="required" name="user_sex"
                                                       value="0">
                                                <label for="user_sex_0">Женский</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-label">Имя</div>
                                    <input type="text" required value="" name="user_name" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-label">Фамилия</div>
                                    <input type="text" required value="" name="user_surname" class="form-control">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-label">Телефон</div>
                                    <input type="text" required value="" name="user_phone" class="form-control">

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-label">E-mail</div>
                                    <input type="email" required value="" maxlength="180" name="user_email"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-label">Страна</div>
                                    <input type="text" value="" name="user_country" class="form-control">

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-label">Город</div>
                                    <input type="text" value="" name="user_city" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-label">Место работы</div>
                                    <input type="text" value="" name="user_work_place" class="form-control">

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-label">Должность</div>
                                    <input type="text" value="" name="user_work_position" class="form-control">
                                </div>
                            </div>
                            <div class="controls">
                                <a href="/" class="change_password">Изменить пароль</a>
                                <button type="submit" class="btn_save_user_data">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
