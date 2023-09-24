<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> --}}

    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('scripts')
</head>

<body>
    <div id="app">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->

                <a class="sidebar-brand p-0" href="/">
                    Bangladesh Accreditation Council
                </a>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item active">
                    <a class="nav-link">
                        <span>Menu</span>
                    </a>
                    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('member.index') }}">Member</a>
                            <a class="collapse-item" href="{{ route('category.index') }}">Category</a>
                            <a class="collapse-item" href="{{ route('items.index') }}">Items</a>
                        </div>
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('stocks-in.index') }}">Stock In</a>
                            <a class="collapse-item" href="{{ route('stocks-out.index') }}">Stock Out</a>
                        </div>
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('stocks') }}">Stocks</a>
                        </div>
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('images.index') }}">Images</a>
                        </div>
                        @if (\Auth::id() == '1')
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('multiple.in') }}">Multiple In</a>
                                <a class="collapse-item" href="{{ route('multiple.out') }}">Multiple Out</a>
                            </div>
                        @endif
                    </div>
                </li>
                
                <a href="{{ route('change-password') }}" class="btn btn-secondary btn-sm">Change Password</a>
                <div class="btn btn-danger btn-sm" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <!-- Topbar -->
                    <div class="bg-white shadow">
                        <div class="row pt-1">
                            <div class="col-md-2">
                               @yield('title')
                            </div>
                            <div class="col-md-3">
                                    @yield("new-button")
                            </div>
                            <div class="col-md-3 text-right">
                                    @yield('pdf-button')
                            </div>
                            <div class="col-md-3 text-right">
                                <p class="btn btn-success btn-sm">{{\Auth::user()->name ?? ''}}</p>                               
                            </div>
                        </div>
                    </div>
                <!-- End of Topbar -->
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->

                    <div class="container-fluid">
                        @yield('content')
                    </div>

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Website: <a href="https://www.bac.gov.bd">www.bac.gov.bd</a></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
    </div>

</body>

</html>
