<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" dir="{{ (__('lang_dir') == 'rtl' ? 'rtl' : 'ltr') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('site_title')</title>



    <meta name="description" content="The best Link shortener for converting lengthy, complex URLs into short, easy to memorize links.Track your links. Use it to shorten links and above all it's free with a Link Management Platform & API.">

    <meta name="keywords" content="url shortener, link management platform, bitly, tinyurl,custom domain link shortener, api, branded urls, branded domian, links shortener, tiny url, short url, short link, links shortening, url traffic stats, url tracking, free url shortener, custom url shortener, shortening url, shorten url, shorten links, url, link, url redirect, shorter link, customize url, customize link, url shortener no ads, url shortener without ads, click stats, cuttlink,cutturl, cutly">
    <link rel="canonical" href="https://wwww.cuttlink.net/">
    @yield('head_content')

    <link href="{{ url('/') }}/uploads/brand/{{ config('settings.favicon') ?? 'favicon.png' }}" rel="icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('style')

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
