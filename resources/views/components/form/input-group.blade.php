<div {{ $attributes->merge(['class' => 'mb-4']) }}>
  @if($label)
  <label @if($for) for="{{ $for }}" @endif class="block text-sm font-semibold leading-6 text-gray-800 dark:text-gray-200">{{ $label }}</label>
  @endif
  {{ $slot }}

  @if($error)
    <span class="mt-1 text-sm text-red-500">{{ $error }}</span>
  @endif
</div>
