<div {{ $attributes->merge(['class' => 'overflow-hidden bg-white shadow sm:rounded-md dark:bg-gray-900']) }}>
    <ul>
        {{ $slot }}
    </ul>
</div>