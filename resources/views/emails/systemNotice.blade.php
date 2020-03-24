@component('mail::message', ['url' => $systemHomepage, 'appName' => $systemName])
{{ $content }}
@endcomponent
