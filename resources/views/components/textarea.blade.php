@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray focus:border-neutral-700 focus:ring-neutral-700 rounded-md shadow-sm']) }}>{{ $slot}}</textarea>
