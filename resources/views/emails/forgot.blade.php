@component('mail::message')

<p>Hello {{ $user->name}}</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Password

@endcomponent

<p>Do you have any issue? please contact us. <br> Thank you.</p>

{{ config('app.name')}}

@endcomponent
