@component('mail::message')
# {{ $post->title }}

{{ $post->description}}

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
