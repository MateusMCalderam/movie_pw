@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-400 space-y-1 mt-2']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center">
                <span class="mr-2">⚠️</span>
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
