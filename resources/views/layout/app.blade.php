<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

@include('includes.header')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Above Header) -->

                @include('includes.sidebar')

            <!-- Main Content (Takes Remaining Space) -->
            <div class="ms-auto" 
                style="margin-left: 500px; background: url('/images/back2_cleanup.jpg') no-repeat right center/cover; height: 100vh;">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
