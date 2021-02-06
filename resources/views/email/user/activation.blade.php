<h1>{{ config('app.name') }}</h1>

<h2>Use this verification code to activate your account:</h2>

<code>{{$code}}</code>

<p>
    <strong>DO NOT SHARE THE CODE WITH ANYONE</strong>.
    If you did not make this request, change your
    password immediately and contact Coins support.
</p>

<p>
    Use this code only in the official {{ config('app.name') }} app or website.
    Carefully check your address bar to make sure you are
    visiting:
</p>

<code>{{ config('app.url') }}</code>

<p>
    Note on account security: {{ config('app.name') }} will never ask for your password and
    verification code via email, text or call. Only log in to the official
    {{ config('app.name') }} homepage. <a href="">Learn more</a>
</p>

<p>Regards,</p>
<strong>The {{ config('app.name') }} TEAM</strong>
