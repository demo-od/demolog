@props(['user'])

@php
   $fcount = $user->followers->count();
@endphp

<div {{ $attributes }} x-data="{
    following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followersCount: {{ $fcount }},
    follow() {
        this.following = !this.following

        axios.post('/follow/{{ $user->username }}')
            .then(res => {
                console.log(res.data)
                this.followersCount = res.data.followersCount
            })
            .catch(err => console.log(err))
    }

}">
{{ $slot }}
</div>
