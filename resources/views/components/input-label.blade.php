@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-white mb-2']) }}>
    {{ $value ?? $slot }}
</label>
