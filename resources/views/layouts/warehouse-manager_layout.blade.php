<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Warehouse Manager Dashboard</title>
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
                <span class="d-none d-lg-block">Rise</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <div class="search-bar d-none d-lg-flex align-items-center ms-auto">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <!-- Icons Navigation -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <!-- Search Icon (Visible on small screens) -->
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon -->

                <li class="nav-item dropdown position-relative">
                    <a class="nav-link nav-icon" href="#" id="notificationDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <!-- Notification Count (Will be removed on click) -->
                        @if ($notifications->count() > 1)
                            <span
                                class="badge bg-primary position-absolute top-0 start-100 translate-middle rounded-circle"
                                id="notificationCount"></span>
                        @endif
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
                        aria-labelledby="notificationDropdown"
                        style="max-height: 300px; overflow-y: auto; width: 250px;">
                        <li class="dropdown-header text-start">
                            Notifications
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- Notification Items -->
                        @forelse ($notifications->sortByDesc('created_at') as $notification)
                            @if ($notification->recipient_role === 'warehouse_manager')
                                <!-- Check if recipient_role is warehouse_manager -->
                                <li class="notification-item d-flex align-items-start">
                                    <a href="{{ route('purchase_req', ['id' => $notification->id]) }}"
                                        class="d-flex align-items-start text-decoration-none text-dark">
                                        <i class="bi bi-exclamation-circle text-warning me-2"></i>
                                        <div>
                                            <h4 class="m-0">{{ $notification->title ?? 'Stock Request' }}</h4>
                                            <p class="m-0">
                                                {{ $notification->message ?? 'New stock Request from Store' }}
                                            </p>
                                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                        @empty
                            <li class="dropdown-item text-center">No notifications available</li>
                        @endforelse


                        <li class="dropdown-footer text-center">
                            <a href="{{ route('purchase_req') }}">Show all notifications</a>
                        </li>
                    </ul>
                </li><!-- End Notification Dropdown -->

                <script>
                    document.getElementById('notificationDropdown').addEventListener('click', function() {
                        var notificationCount = document.getElementById('notificationCount');

                        if (notificationCount && parseInt(notificationCount.innerText) > 0) {
                            notificationCount.style.display = 'none';

                            // AJAX request to mark notifications as read
                            fetch('/notifications/mark-read', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add the CSRF token for security
                                    },
                                    body: JSON.stringify({
                                        // Optionally send any necessary data
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Notifications marked as read');
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                </script>





                <!-- Profile Dropdown -->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('admin_assets/assets/img/profile-img.jpg') }}" alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block ms-2">{{ auth()->user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->name }}</h6>
                            <span class="d-none d-lg-block text-capitalize">
                                <?php $user = Auth::user();
                                echo $user['first_name'] . ' ' . $user['last_name']; ?>
                            </span>
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
                    </ul><!-- End Profile Dropdown -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->



    {{-- <!-- Notification Icon with Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notificationDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        {{-- {{ $myvar }} --}}
    {{-- @forelse ($notifications as $notification)
                            @if ($notification->recipient_role === 'warehouse_manager')
                                <a class="dropdown-item">{{ $notification }}</a>
                            @else
                                <a class="dropdown-item">No notifications for your role</a>
                            @endif
                        @empty
                            <a class="dropdown-item">No record found</a>
                        @endforelse

                </li> --}}







    {{-- <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li> --}}


    <!-- End Notification Nav




                Notification Dropdown -->
    {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have {{ auth()->user()->unreadNotifications->count() }} new notifications
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                        all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Notification Items -->
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <li class="notification-item">
                                    <i class="bi bi-exclamation-circle text-warning"></i>
                                    <div>
                                        <h4>Stock Request #{{ $notification->data['request_id'] }}</h4>
                                        <p>{{ $notification->data['store_name'] }} requested
                                            {{ $notification->data['quantity'] }} units of
                                            {{ $notification->data['product'] }}</p>
                                        <small>Requested on:
                                            {{ \Carbon\Carbon::parse($notification->created_at)->format('d M Y, H:i') }}</small>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endforeach

                            <!-- Notification Footer -->
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>
                        </ul> --}}







    {{-- <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('admin_assets/assets/img/profile-img.jpg') }}" alt="Profile"
                        class="rounded-circle">

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

    </header><!-- End Header --> --}}

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                    href="{{ route('warehouse') }}">

                    <i class="bi bi-grid"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>



                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('warehouse') }}">
                            <i class="bi bi-circle"></i><span>Stocks</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('outbound_stocks') }}">
                            <i class="bi bi-circle"></i><span>Outbound</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categorization') }}">
                            <i class="bi bi-circle"></i><span>Categorization</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->





            <li class="nav-item">
                <a class="nav-link collapsed " href="{{ route('purchase_req') }}">
                    <i class="bi bi-receipt"></i>
                    <span>Purchase Request</span>
                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('generateQR') }}">
                    <i class="bi bi-plus-square"></i>
                    <span>Add Product</span>
                </a>
            </li>



            <!-- End Dashboard Nav -->


            <!-- End Dashboard Nav -->


    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">@yield('')</h1>
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
