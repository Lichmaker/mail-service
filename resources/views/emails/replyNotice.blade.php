@component('mail::message', ['url' => $url, 'appName' => $systemName])
{{ $username }} 您好！

您在我们网站中的评论有一条新回复哦，请注意查收 ^ ^

> {{ $originContent }}

------

> {{ $replyUsername }} : {{ $content }}

<a href="{{ $articleUrl }}" style="display: inline-block;">点击马上传送到对应位置！</a>

@endcomponent
