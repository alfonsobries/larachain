<div {{ $attributes->merge(['class' => 'mb-4']) }}>
  @if($label)
  <label @if($for) for="{{ $for }}" @endif class="block text-sm font-semibold leading-6 text-gray-800">{{ $label }}</label>
  @endif
  {{ $slot }}
</div>