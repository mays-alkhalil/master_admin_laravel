<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    
    <!-- تحميل Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- تحميل DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">

    <!-- تحميل jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- تحميل DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
    
    <!-- تحميل DataTables Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

@include('layouts.inc.admin-navbar')
<div id="layoutSidenav">
    @include('layouts.inc.admin-sidebar')

    <div id="layoutSidenav_content">
        <main>
           @yield('content') 
        </main>

        @include('layouts.inc.admin-footer')
    </div>
</div>

<!-- تحميل Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "paging": true,  // تمكين الباجينيشن
            "searching": true,  // تمكين البحث
            "info": true,  // تمكين معلومات الصفحات
            "lengthChange": true,  // تمكين تغيير عدد العناصر المعروضة
            "autoWidth": false  // تعيين تلقائي للعرض
        });
    });
</script>

@yield('scripts')

</body>
</html>
