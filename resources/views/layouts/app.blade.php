<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    @stack('style')

    <style>
        body {
            background-color: #000; /* Background color for dark theme */
            color: #fff; /* Text color */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Full height */
        }

        .wrapper {
            flex: 1; /* Allow wrapper to grow and fill available space */
            display: flex; /* Enable flexbox for layout */
        }

        .content {
            flex: 1; /* Allow content to grow and fill available space */
            padding: 15px; /* Add padding to content */
        }

        .footer {
            background-color: #343a40; /* Dark background for footer */
            text-align: center; /* Center align text */
            padding: 15px 0; /* Vertical padding */
        }

        .footer p {
            margin: 0; /* Remove default margin */
            color: #ffffff; /* Footer text color */
            text-align: center; /* Center align text */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Include Navbar Component -->
        <x-navbar></x-navbar>

        <!-- Include Sidebar Component -->
        <x-sidebar-perpus img="" nama="STARBOY"></x-sidebar>

        <!-- Content -->
        <div class="content content-shifted" id="content">
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Perpustakaan. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @stack('scripts')
</body>

</html>
