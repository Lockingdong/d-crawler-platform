@extends('layouts.app')

@section('content')
    <div class="container-md">
        <div class="row justify-content-center">

            @auth
            <div class="col-md-12 mb-2">
                <a href="{{ route('home') }}">網頁爬蟲紀錄</a>
            </div>
            @endauth
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-header">網頁爬蟲</div>

                    <div class="card-body" style="overflow: scroll;">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="root">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


        <div id="root">
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html> --}}
