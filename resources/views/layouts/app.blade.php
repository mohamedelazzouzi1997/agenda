<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    @yield('meta')
    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @yield('before-styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    @if (trim($__env->yieldContent('page-style')))
        @yield('page-style')
    @endif
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toaster/toaster.css') }}">
    @yield('after-styles')
    @livewireStyles
</head>
<?php
$setting = !empty($_GET['theme']) ? $_GET['theme'] : '';
$theme = 'theme-blush';
$menu = '';
if ($setting == 'p') {
    $theme = 'theme-purple';
} elseif ($setting == 'b') {
    $theme = 'theme-blue';
} elseif ($setting == 'g') {
    $theme = 'theme-green';
} elseif ($setting == 'o') {
    $theme = 'theme-orange';
} elseif ($setting == 'bl') {
    $theme = 'theme-cyan';
} else {
    $theme = 'theme-blush';
}

if (Request::segment(2) === 'rtl') {
    $theme .= ' rtl';
}
?>

<body class="<?= $theme ?>">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin mx-auto" src="../assets/images/logo.svg" width="48"
                    height="48" alt=""></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    @include('layouts.navbarright')
    @include('layouts.sidebar')
    @include('layouts.rightsidebar')
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>@yield('title')</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        @if (trim($__env->yieldContent('parentPageTitle')))
                            <li class="breadcrumb-item">@yield('parentPageTitle')</li>
                        @endif
                        @if (trim($__env->yieldContent('title')))
                            <li class="breadcrumb-item active">@yield('title')</li>
                        @endif
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    @yield('modal')
    @include('modals.addNotification')
    <!-- Scripts -->
    @yield('before-scripts')
    <script src="{{ asset('js/jquery-3.6.3.js') }}"></script>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('toaster/toaster.js') }}"></script>
    @yield('after-scripts')
    @if (trim($__env->yieldContent('page-script')))
        @yield('page-script')
    @endif
    @livewireScripts
</body>

</html>
