<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DHA HR | {{isset($title) ? $title : 'Dashboard'}}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />
    <style>
        .content-wrapper{
            background: #fff;
        }
    </style>
    @yield('styles')
</head>

<body class="layout-fixed sidebar-collapse">
    <div class="wrapper">

        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    @yield('scripts')

</body>

</html>