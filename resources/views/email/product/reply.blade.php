@component('mail::message')
# Introduction

Hello , {{$email}} <br>
{{$message}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
