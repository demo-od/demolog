@props([
    'name' => null, 
    'size' => '12', // Default size (matches w-12 h-12)
    'fontSize' => 'base' // Default text size
])

@php
    $initial = $name ? strtoupper(substr($name, 0, 1)) : '?';
    
    // Construct Tailwind classes dynamically
    // We use a mapping or template literals for common sizes
    $containerClasses = "w-{$size} h-{$size} text-{$fontSize}";
@endphp

<div {{ $attributes->merge(['class' => "$containerClasses bg-neutral-900 text-white flex items-center justify-center font-bold rounded-full border border-gray-100 shrink-0"]) }}>
    <span>{{ $initial }}</span>
</div>