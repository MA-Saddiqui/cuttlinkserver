<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" dir="{{ (__('lang_dir') == 'rtl' ? 'rtl' : 'ltr') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('site_title')</title>

    <meta name="description" content="A Powerful Short link generator for short URLs with custom domain names and a fully trackable links generator.">
    <meta name="google-site-verification" content="ErqzRZA3P4acE0fOzglRlWIO7rsi6SVLmfL7vLsxDm4" />
    <meta name="description" content="Link shortner with the power of trackable pixels so you can track link audience with a detailed data based on audience demographic.Now you can generate your short urls with custom domain name with our free url shortner">
    @yield('head_content')

    <link href="{{ url('/') }}/uploads/brand/{{ config('settings.favicon') ?? 'favicon.png' }}" rel="icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app'. (__('lang_dir') == 'rtl' ? '.rtl' : '') . (config('settings.dark_mode') == 1 ? '.dark' : '').'.css') }}" rel="stylesheet" id="app-css">

    @if(isset(parse_url(config('app.url'))['host']) && parse_url(config('app.url'))['host'] == request()->getHost())
        {!! config('settings.tracking_code') !!}
    @endif

    @if(config('settings.custom_css'))
        <style>
          {!! config('settings.custom_css') !!}
        </style>
    @endif
</head>
@yield('body')
</html>
