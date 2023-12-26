@component('mail::message')
Заявка №{{ $requestId }}
<br>
{{ $comment }}
<br>
<br>
{{ config('app.name') }}.
@endcomponent