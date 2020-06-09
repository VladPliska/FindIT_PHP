<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FindIT</title>

    <!-- Scripts -->
    <script src="js/app.js" defer></script>
    <link rel="icon" href="/img/white-logo.png" type="image/png"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/71de464d86.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>

