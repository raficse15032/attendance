
<h1>Hello</h1>
<p>
	Reset Password
	<a href="{{ env('APP_URL')}}/reset-password/{{$user->email}}/{{$code}}">Reset Password</a>
</p>
