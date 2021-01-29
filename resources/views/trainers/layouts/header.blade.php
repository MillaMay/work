    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <span class="c-header-toggler-icon"></span>
        </button>
        <a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="/assets/brand/coreui-base.svg" width="97" height="46" alt="CoreUI Logo"></a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <span class="c-header-toggler-icon"></span>
        </button>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img" src="{{$trainer->avatar}}" title="{{$trainer->name}}"></div>
                </a>

                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>@lang('trainers.settings')</strong></div>
                    <a class="dropdown-item" href="{{route('profile.edit', $trainer->id)}}">
                        <svg class="c-icon mr-2">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                        </svg> @lang('trainers.profile')
                    </a>
                    <div class="dropdown-item">
                        <svg class="c-icon mr-2">
                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-account-logout"></use>
                        </svg>
                        <a class="logout" href="{{route('logout')}}">@lang('trainers.logout')</a>
                    </div>
                </div>

            </li>
        </ul>
        <div class="c-subheader px-3">
            @include('trainers.components.breadcrumbs')
        </div>
    </header>

