<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sidenav Light - SB Admin</title>
    <link href="{{ asset('backend') }}/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
 
    @include('layouts.topbar')
    <div id="layoutSidenav">
       
        @include('layouts.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
              @yield('admin')
                    
                </div>
            </main>
          @include('layouts.footer')
        </div>
    </div>
    <script src="{{ asset('backend') }}/js/bootstrap.bundle.min.js" ></script>
    <script src="{{ asset('backend') }}/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('backend') }}/js/datatables-simple-demo.js"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>

    @stack('dashboard')
</body>

</html>