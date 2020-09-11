@if(!$href)    
<button
    type="{{ $type }}"
    class="{{ $classes }}"
    {{ $attributes }}
>
    {{ $slot }}
</button>
@else
<a
    href="{{ $href }}"
    class="{{ $classes }}"
    {{ $attributes }}
>
    {{ $slot }}
</a>
@endif

