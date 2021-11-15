<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Buttons Dashboard</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-blue-400 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="grid justify-items-center">
                <x-application-logo />
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg border-2 border-gray-600">
                <div class="p-10">
                    <div class="mt-2 text-center">
                        <div class="text-2xl">Welcome to</div>
                        <div class="m-4 text-3xl text-purple-900 font-extrabold">Simple Buttons Dashboard</div>
                        <div class="mt-9">
                            <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full m-5">
                                Login
                            </a>
                            <span>or</span>
                            <a href="/register" class="bg-green-600 hover:bg-green-800 text-white font-bold py-3 px-5 rounded-full m-5">
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>