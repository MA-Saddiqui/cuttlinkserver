@extends('layouts.wrapper')

@section('body')
    <body class="d-flex flex-column">
        @include('shared.header')

        <div class="d-flex flex-column flex-fill @auth content @endauth">
            <main>
                @yield('content')
            </main>


            @include('shared.footer')
        </div>
    </body>
@endsection
