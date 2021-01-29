<header class="header d-flex flex-row align-items-center">
    <div class="header_logo">
        <a href="#">
            <img src="{!! asset('assets/img/logo.svg') !!}" alt="">
        </a>
    </div>
    <div class="header_nav d-flex flex-row justify-content-end align-items-center">
        <div class="header_nav_catalog">
            <button class="btn btn-block btn-info" type="button"><a href="/" style="color: white">КАТАЛОГ КУРСОВ</a></button>
        </div>
        <div class="header_nav_profile">
            <div class="avatar-header">
                <img src="{!! isset($user->avatar) ? $user->avatar : asset('assets/img/empty_profile.png') !!}" alt="">
            </div>
            <div class="btn-group">
                <button class="btn btn-outline-info" type="button"><a href="{{route('profile')}}" style="color: white">{{$user->name}}</a></button>
                <button class="btn btn-outline-info dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('profile')}}">Профиль</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}">Выход</a>
                </div>
            </div>
        </div>
    </div>

</header>
