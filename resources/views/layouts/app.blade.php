<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Black Dashboard') }}</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
        <link rel="icon" type="image/png" href="{{ asset('black') }}/img/favicon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="{{ asset('black') }}/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet" />

        <script type="text/javascript" src="../assets/js/jquery-1.2.6.pack.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.maskedinput-1.1.4.pack.js"/></script>
        <script type="text/javascript" src="jquery.js"></script> 
        <script type="text/javascript" src="jquery.tablesorter.js"></script>
</head>
<body class="{{ $class ?? '' }}">
    @include('layouts.navbars.navbar')
    <div class="wrapper wrapper-full-page">
        <div class="full-page {{ $contentClass ?? '' }}">
            <div class="content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('black') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('black') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <!-- Chart JS -->
{{--    <sc    ript src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script> --}}
<!--  Notifications Plugin    -->
<script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>

<script src="{{ asset('black') }}/js/black-dashboard.min.js?v=1.0.0"></script>
<script src="{{ asset('black') }}/js/theme.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
<script src="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
@stack('js')

<script>
    $(document).ready(function () {
        $('#order').dataTable({
            "sDom": '<fl<t>ip>',
            "oLanguage": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Total de _TOTAL_ registros (_START_ a _END_)",
                "sSearch": "Buscar: ",
                "oPaginate": {
                    "sNext": "  Proxima ",
                    "sPrevious": "Anterior  ",
                },
                "sLengthMenu": 'Filtrar <select style>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="50">100</option>' +
                        '<option value="-1">All</option>' +
                        '</select>  Resultados'
            }
        });
    });
</script>
@stack('js')
</body>
</html>
