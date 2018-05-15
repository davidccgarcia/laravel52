<p>
    Hi, {{ $user->name }}. @lang('email.registration') by clicking on the following link:

    <a href="{{ $url }}">{{ $url }}</a>
</p>