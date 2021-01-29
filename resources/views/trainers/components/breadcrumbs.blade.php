@isset($breadcrumbs)
    <ol class="breadcrumb border-0 m-0">
        @foreach($breadcrumbs as $breadcrumb)
            @if($loop->last)
                <li class="breadcrumb-item active">{{$breadcrumb['title']}}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{$breadcrumb['href']}}">{{$breadcrumb['title']}}</a>
                </li>
            @endif
        @endforeach
    </ol>
@endisset
