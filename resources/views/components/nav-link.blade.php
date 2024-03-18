@props(['active', 'href' => '#'])
@php
    $classes = $active ? 'btn-success font-weight-bolder' : 'btn-outline-success';
@endphp
<li>
    <a href="{{ $href }}"  class="m-1 btn {{$classes}}">
        {{ $slot }}
    </a>
</li>
