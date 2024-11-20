<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <style>
        /* Color Palette */
        :root {
            --bg-primary: #1c1c1e;
            --bg-secondary: #2c2c2e;
            --bg-tertiary: #3a3a3c;
            --text-primary: #ffffff;
            --text-secondary: #ababab;
            --accent-color: #5e5ce6;
        }

        /* General styles */
        body {
            padding-top: 56px;
            /* Height of the navbar */
            background-color: var(--bg-primary);
            color: var(--text-primary);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Full height */
            font-family: 'Inter', sans-serif;
        }

        .wrapper {
            display: flex;
            flex: 1;
            /* Allow wrapper to grow and fill available space */
        }

        .content {
            flex-grow: 1;
            margin-left: 0;
            transition: margin-left 0.3s ease;
            background-color: var(--bg-primary);
            position: relative;
            /* Add padding to content */
        }

        /* Navbar styling */
        .navbar {
            background-color: var(--bg-secondary);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-primary);
        }

        .navbar .btn-outline-light {
            margin-right: auto;
        }

        .dropdown-menu-end {
            right: 0;
            left: auto;
        }

        /* Sidebar styling */
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 56px;
            height: calc(100% - 56px);
            background-color: var(--bg-secondary);
            border-right: 1px solid var(--bg-tertiary);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--bg-tertiary);
            padding: 15px;
        }

        .sidebar-header h4 {
            color: var(--text-primary);
            margin-bottom: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
            opacity: 0.7;
            padding-left: 10px;
        }

        /* Accordion Styling */
        .accordion-button {
            background-color: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-color: var(--bg-tertiary) !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--bg-tertiary) !important;
            color: var(--text-primary) !important;
        }

        .accordion-button::after {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .accordion-body {
            background-color: var(--bg-secondary);
            padding: 0;
        }

        /* Navigation Links */
        .nav-link {
            color: var(--text-secondary);
            padding: 10px 15px;
            display: flex;
            align-items: center;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }

        .nav-link i {
            margin-right: 10px;
            color: var(--text-secondary);
        }

        .nav-link.active i {
            color: var(--text-primary);
        }

        /* List Group Styling */
        .list-group-item {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            border-color: var(--bg-tertiary);
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: var(--bg-tertiary);
        }

        .list-group-item.active {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            border-color: var(--bg-tertiary);
        }

        /* Logout Styling */
        .logout .dropdown-item {
            color: #dc3545;
            background-color: transparent;
        }

        .logout .dropdown-item:hover {
            background-color: var(--bg-tertiary);
        }

        /* Profile Image */
        .rounded-circle {
            border: 2px solid var(--bg-tertiary);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
                width: 100%;
            }

            .sidebar.show-sidebar {
                left: 0;
            }
        }

        .nav-link {
            font-size: 1.1rem;
            margin: 10px 0;
            display: flex;
            align-items: center;
            color: var(--text-secondary);
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link .fas {
            font-size: 1.25rem;
        }

        .nav-link.active {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }

        /* Footer styling */
        .footer {
            background-color: var(--bg-secondary);
            text-align: center;
            padding: 15px 0;
            position: absolute;
            bottom: 0;
            width: 100%
        }

        .footer p {
            margin: 0;
            color: var(--text-secondary);
            text-align: center;
        }

        /* Dropdown and list group */
        .dropdown-menu {
            background-color: var(--bg-secondary);
            border-color: var(--bg-tertiary);
        }

        .dropdown-item {
            color: var(--text-primary);
        }

        .dropdown-item:hover {
            background-color: var(--bg-tertiary);
        }

        .list-group {
            list-style-type: none;
            text-align: left;
        }

        .list-group-item {
            border: 0;
            transition: all 300ms;
            background-color: transparent;
            color: var(--text-primary);
        }

        .list-group-item:hover {
            background-color: var(--bg-tertiary);
        }

        li.logout:hover a {
            color: #dc2626 !important;
        }

        /* Responsive adjustments */
        @media (min-width: 769px) {
            .sidebar {
                left: -250px;
                /* Hide sidebar by default on desktop */
            }

            .content {
                margin-left: 0;
            }

            .sidebar.show-sidebar {
                left: 0;
            }

            .content.content-shifted {
                margin-left: 250px;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding-top: 20px;
            }

            .navbar-brand {
                font-size: 1.25rem;
            }

            .btn-outline-light {
                font-size: 1.25rem;
            }

            .sidebar.show-sidebar {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .content.content-shifted {
                margin-left: 0;
                /* Don't shift content on mobile */
            }
        }

        @media (min-width: 769px) {
            .content.content-shifted {
                margin-left: 250px;
            }
        }

        /* Additional utility classes */
        .text-muted {
            color: var(--text-secondary) !important;
        }

        .bg-dark-custom {
            background-color: var(--bg-secondary) !important;
        }

        /* Scrollbar styling (for webkit browsers) */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--bg-tertiary);
            border-radius: 4px;
        }

        /* Tambahkan atau modifikasi di dalam <style> */

        /* Mobile-first responsive adjustments */
        @media (max-width: 768px) {
            body {
                padding-top: 56px;
            }

            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                top: 56px;
                left: -250px;
                width: 100%;
                max-width: 250px;
                height: calc(100vh - 56px);
                transition: left 0.3s ease;
                z-index: 1040;
                overflow-y: auto;
            }

            .sidebar.show-sidebar {
                left: 0;
            }

            .content {
                width: 100%;
                margin-left: 0 !important;
                padding: 15px;
            }

            /* Navbar adjustments */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1050;
            }

            .navbar-toggler {
                display: block;
            }

            /* Typography adjustments */
            body {
                font-size: 14px;
            }

            h1 {
                font-size: 1.5rem;
            }

            h2 {
                font-size: 1.3rem;
            }

            h3 {
                font-size: 1.2rem;
            }

            /* Form and input adjustments */
            .form-control {
                font-size: 14px;
                padding: 8px 12px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 14px;
            }

            /* Table responsiveness */
            .table-responsive {
                overflow-x: auto;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
            }

            /* Card adjustments */
            .card {
                margin-bottom: 15px;
            }

            /* Sidebar menu adjustments */
            .sidebar .nav-link {
                padding: 10px;
                font-size: 1rem;
            }

            /* Footer adjustments */
            .footer {
                padding: 10px;
                font-size: 0.8rem;
            }
        }

        /* Landscape orientation adjustments */
        @media (max-width: 768px) and (orientation: landscape) {
            .sidebar {
                width: 200px;
                max-width: 200px;
            }

            .content {
                padding: 10px;
            }
        }

        /* Small mobile devices */
        @media (max-width: 375px) {
            body {
                font-size: 12px;
            }

            .sidebar {
                max-width: 100%;
            }

            .content {
                padding: 10px;
            }

            .navbar-brand {
                font-size: 1rem;
            }
        }

        /* Touchscreen device improvements */
        @media (pointer: coarse) {

            .nav-link,
            .btn {
                min-height: 44px;
                /* Recommended touch target size */
                min-width: 44px;
                padding: 10px 15px;
            }

            .dropdown-item {
                min-height: 44px;
                display: flex;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Include Navbar Component -->
        <x-navbar></x-navbar>

        <!-- Include Sidebar Component -->
        <x-sidebar-perpus img="" nama="Saya"></x-sidebar>

            <!-- Content -->
            <div class="content content-shifted" id="content">
                @yield('content')
                <footer class="footer">
                    <p>&copy; {{ date('Y') }} Nusantara Library - Perpustakaan Digital Indonesia. Hak Cipta
                        Dilindungi.</p>
                </footer>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @stack('scripts')
</body>

</html>
