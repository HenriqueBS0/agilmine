@props(['href' => '#', 'active' => false])

@if ($active)
    <a class="btn btn-primary text-start ps-3" aria-current="page">{{ $slot }}</a>
@else
    <a class="nav-link btn text-start ps-3" href="{{ $href }}">{{ $slot }}</a>
@endif
