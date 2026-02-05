@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-orange-600 space-y-1 ']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-[11px] text-orange-400 text-center  ">{{ $message }}</li>
        @endforeach
    </ul>
@endif
