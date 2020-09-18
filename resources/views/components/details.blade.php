<div {{ $attributes->merge(['class' => 'overflow-hidden bg-white shadow sm:rounded-md']) }}>
    <ul>
        {{ $slot }}
    </ul>
</div>