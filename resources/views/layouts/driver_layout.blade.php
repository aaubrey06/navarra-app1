<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Driver Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('admin_assets/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('admin_assets/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin_assets/assets/css/style.css') }}" rel="stylesheet">


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSV1H3B9U0Ze4jyL05cJliB9CR7Zk14d4&libraries=places">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #map {
            height: 500px;
            width: 100%;
        }

        #controls {
            padding: 10px;
            background: #f9f9f9;
        }

        #controls input,
        #controls button {
            margin: 5px 0;
            padding: 10px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #controls ul {
            list-style: none;
            padding: 0;
        }

        #controls ul li {
            background: #e9e9e9;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
        }

        #clear-fields {
            background: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }

        #directions-panel {
            margin-top: 10px;
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Rise</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <!-- Notification Dropdown -->
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">3</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 3 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Alert Notification</h4>
                                <p>New delivery request received.</p>
                                <p>30 minutes ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Delivery Failure</h4>
                                <p>Delivery to customer failed.</p>
                                <p>1 hour ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Delivery Success</h4>
                                <p>Delivery to customer completed.</p>
                                <p>2 hours ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Menu -->

                </li><!-- End Notification Nav -->





                <li class="nav-item dropdown pe-3">
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="{{ asset('admin_assets/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
        
        @if(auth()->check())
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
        @else
            <span class="d-none d-md-block dropdown-toggle ps-2">Guest</span>
        @endif
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
            @if(auth()->check())
                <h6>{{ auth()->user()->name }}</h6>
                <span class="d-none d-lg-block text-capitalize">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
            @else
                <h6>Guest</h6>
                <span class="d-none d-lg-block">Not Logged In</span>
            @endif
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        @if(auth()->check())
            <li>
                <a class="dropdown-item d-flex align-items-center" href="/profile">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        @else
            <li>
                <a class="dropdown-item d-flex align-items-center" href="/login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li>
        @endif
    </ul><!-- End Profile Dropdown Items -->
</li><!-- End Profile Nav -->


            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('orders') }}">
                    <i class="bi bi-cart"></i>
                    <span>Orders</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('schedule') }}">
                    <i class="bi bi-calendar"></i>
                    <span>Schedule</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('routes') }}">
                    <i class="bi bi-map"></i>
                    <span>Routes</span>
                </a>
            </li><!-- End Tables Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">


        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
            </div>

            @yield('contents')

        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer --> --}}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('admin_assets/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('admin_assets/assets/js/main.js') }}"></script>

</body>

</html>
