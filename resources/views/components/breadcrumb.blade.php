@props(['items'])

<nav class="nav-breadcrumb py-2 px-5 small border-bottom" aria-label="breadcrumb">
    <ol class="breadcrumb m-0">
        @foreach ($items as $item)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ call_user_func_array('route', collect($item)->except('title')->toArray()) }}">{{ $item['title'] }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
