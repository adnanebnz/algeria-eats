@props(['rating'])

@php
    $fullStars = floor($rating);
@endphp

<div>
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $fullStars)
            <i class="fas fa-star text-yellow-400"></i>
        @else
            <i class="far fa-star text-yellow-400"></i>
        @endif
    @endfor
</div>
