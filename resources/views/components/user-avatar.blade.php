@props(['user'])

@if ($user->image)
    <div class="circle-container">
        <img src="{{ $user->image }}" class="w-12 h-12" />
    </div>
@else
    <x-default-image class="w-12 h-12 -mr-2" />
@endif
