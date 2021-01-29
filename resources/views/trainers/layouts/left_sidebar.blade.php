<div class="c-sidebar-brand"><a class="brand" href="{{route('home')}}">HR</a></div>
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('courses.index')}}">
            <span class="cil-color-border c-sidebar-nav-icon"></span>
            @lang('courses.title')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('lessons.index')}}">
            <span class="cil-file c-sidebar-nav-icon"></span>
            @lang('lessons.title')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('materials.index')}}">
            <span class="cil-folder-open c-sidebar-nav-icon"></span>
            @lang('materials.title')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('tests.index')}}">
            <span class="cil-list c-sidebar-nav-icon"></span>
            @lang('tests.title')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('questions.index')}}">
            <span class="cil-hand-point-up c-sidebar-nav-icon"></span>
            @lang('questions.title')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('tasks.index')}}">
            <span class="cil-description c-sidebar-nav-icon"></span>
            @lang('tasks.title')
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('members.index')}}">
            <span class="cil-happy c-sidebar-nav-icon"></span>
            @lang('members.title')
        </a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
