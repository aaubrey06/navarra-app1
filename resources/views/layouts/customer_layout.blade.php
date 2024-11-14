<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Customer Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @yield('styles')

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Leaflet CSS -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/> --}}

    <!-- Leaflet JS -->
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script> --}}

    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSV1H3B9U0Ze4jyL05cJliB9CR7Zk14d4&libraries=places"> --}}
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

    <!-- Leaflet CSS -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/> --}}

    <!-- Leaflet JS -->
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script> --}}
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

        {{-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar --> --}}

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                {{-- Cart Navbar --}}
                {{-- <li class="nav-item">
                    <a class="nav-link nav-icon" href="{{ route('cart') }}">
                        <i class="bi bi-cart-plus"></i>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link nav-icon position-relative" href="{{ route('cart') }}">
                        <i class="bi bi-cart-plus"></i>
                        @php
                            $cartItems = session('cartItems', []);
                            $itemCount = count($cartItems);
                        @endphp
                        @if ($itemCount > 0)
                            <span class="custom-badge">
                                {{ $itemCount }}
                            </span>
                        @endif
                    </a>
                </li>


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('admin_assets/assets/img/profile-img.jpg') }}" alt="Profile"
                            class="rounded-circle">
                    </a>


                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->name }}</h6>
                            <span
                                class="d-none d-lg-block text-capitalize">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('customer-profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('customer-account-settings') }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
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

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <!--<a class="nav-link" href="">-->
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
                <!--</a>-->
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer-dashboard') }}">
                    <i class="bi bi-menu-button-wide"></i><span>Products</span>
                </a>

            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('cart') }}">
                            <i class="bi bi-circle"></i><span>My Cart</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.order-list') }}">
                            <i class="bi bi-circle"></i><span>Order List</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('history') }}">
                    <i class="bi bi-menu-button-wide"></i><span>History</span>
                </a>

            </li><!-- End Tables Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        {{-- <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title --> --}}


        <!-- Dynamic Content Section -->
        @yield('contents')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
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
    </footer><!-- End Footer -->

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

    @yield('scripts')
</body>

</html>
