<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ env('APP_NAME') }}</title>

  <!-- Style Link start -->
  @include('components.partials._head')
  <!-- Style Link end -->
  <style>
    body{
      background-image: url("/images/logo/splash-screen.jpg") !important;
      height: 100%;
      width: 100%;
      background-size: cover;
      background-attachment:fixed;
      background-position:center bottom;
      background-repeat: no-repeat;

    }
  </style>
</head>

<body class="light theme-default theme-color-default">

<!-- Loader start -->
<div id="loading">
  <x-partials._body_loader/>
</div>
<!-- Loader end -->

<!-- Wrapper / Page Content Start-->
<div class="wrapper">
  {{ $slot }}
</div>
<!-- Wrapper / Page Content End-->


<!-- Script Link start -->
@include('components.partials._scripts')
<!-- Script Link end -->

<!-- Notification Script start -->
<x-partials._app_toast/>
<!-- Notification Script end -->
</body>

</html>
