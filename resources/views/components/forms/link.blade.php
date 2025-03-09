@props(['label', 'name', 'href'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full h-full block',
    ];
@endphp

<x-forms.field :$label :$name>
    <a {{ $attributes($defaults) }} href="{{ $href }}">Learn more</a>
</x-forms.field>
