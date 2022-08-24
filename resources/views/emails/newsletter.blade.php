@component('mail::message')

@foreach($posts as $i => $post)
# {{ $i }}.) {{ $post['title'] }}
{{ $post['description'] }}

@endforeach

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent