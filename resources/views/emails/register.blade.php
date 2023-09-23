@component('mail::message')

<p>Hello {{ $user->name}}</p>

@component('mail::button', ['url' => url('verify/'.$user->remember_token)])
Verify

@endcomponent

<p>Do you have any issue? please contact us. <br> Thank you.</p>

{{ config('app.name')}}

@endcomponent
