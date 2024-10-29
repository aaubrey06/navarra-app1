<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Store Manager Dashboard</title>
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
                <span>Rise</span>
                {{-- <span class="d-none d-lg-block text-capitalize"><?php $user = Auth::user();
                echo $user['first_name'] . ' ' . $user['last_name']; ?></span> --}}
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





                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('admin_assets/assets/img/profile-img.jpg') }}" alt="Profile"
                            class="rounded-circle">

                        <span class="d-none d-md-block dropdown-toggle ps-2"> {{ auth()->user()->name }}</span>
                        @if (auth()->check())
                            <!-- Check if user is authenticated -->
                        @endif
                    </a>


                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->name }}</h6>
                            <span class="d-none d-lg-block text-capitalize"><?php $user = Auth::user();
                            echo $user['first_name'] . ' ' . $user['last_name']; ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
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
                <a class="nav-link collpased" href="{{ route('owner-dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                    href="{{ route('store_manager.orders.index') }}">
                    <i class="bi bi-cart"></i><span>Orders</span><i></i>
                </a>

            </li><!-- End Components Nav -->

            <!-- End Forms Nav -->

            <!--Product  Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed " href="{{ route('owner.products') }}">
                    <i class="bi bi-box"></i>
                    <span>Products</span>
                </a>
            </li><!-- End Product Dashboard Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="">
                    <i class="bi bi-person"></i>
                    <span>Walk-in</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse"
                    href="{{ route('inventory') }}">
                    <i class="bi bi-card-checklist"></i><span>Inventory</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('store_manager.sales.sales') }}">
                            <i class="bi bi-circle"></i><span>Sales</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stocks') }}">
                            <i class="bi bi-circle"></i><span>Stocks</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warehouse_manager.warehouse') }}">
                            <i class="bi bi-circle"></i><span>Warehouse Stocks</span>
                        </a>
                    </li>
                    <li>
                        <a href="store_manager.purchase_order.index">
                            <i class="bi bi-circle"></i><span>Purchase Stocks</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('store_manager.inventory.stockrequest') }}">
                            <i class="bi bi-circle"></i><span>Request Stocks</span>
                        </a>
                    </li>

                </ul>
            </li>

            <!-- Delivery Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('delivery') }}">
                    <i class="bi bi-truck"></i>
                    <span>Delivery</span>
                </a>
            </li><!-- EndDelivery  Dashboard Nav -->



            </li><!-- End Tables Nav -->



            <!-- REports Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('reports') }}">
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Reports</span>
                </a>
            </li><!-- End Reports Dashboard Nav -->



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
