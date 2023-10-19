<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FRYCRYPTO EXPLORER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    @vite(['resources/sass/app.scss','resources/css/app.css', 'resources/js/explorer.js'])
</head>
<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class='sidebar-brand' href='index.html'>
                <span class="align-middle d-flex justify-content-center align-items-center gap-2">
                    <img src="{{asset('assets/images/logo.png')}}" style="width: 120px" alt="">
                </span>
            </a>
            <ul class="sidebar-nav">
                <li class="sidebar-item active">
                    <a class='sidebar-link' href='{{route('explorer.index')}}'>
                        <i class="align-middle" data-feather="pie-chart"></i>
                        <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class='sidebar-link' href='{{route('explorer.accounts')}}'>
                        <i class="align-middle" data-feather="user"></i>
                        <span class="align-middle">Accounts</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class='sidebar-link' href='{{route('explorer.miners')}}'>
                        <i class="align-middle" data-feather="credit-card"></i>
                        <span class="align-middle">Miners</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class='sidebar-link' href='{{route('explorer.transactions')}}'>
                        <i class="align-middle" data-feather="layers"></i>
                        <span class="align-middle">Transactions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class='sidebar-link' href='{{route('explorer.blocks')}}'>
                        <i class="align-middle" data-feather="box"></i>
                        <span class="align-middle">Blocks</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-cta">
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='#'>
                            <i class="align-middle" data-feather="home"></i>
                            <span class="align-middle">Home</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='#'>
                            <i class="align-middle" data-feather="map"></i>
                            <span class="align-middle">Explorer</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='#'>
                            <i class="align-middle" data-feather="file-text"></i>
                            <span class="align-middle">Docs</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>
                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <span class="text-dark">Charles Hall</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">
                                <i class="align-middle me-1" data-feather="pie-chart"></i>
                                Analytics
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content">
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container-fluid">
                <div class="float-end">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="https://twitter.com/frycrypto" target="_blank"
                               style="font-size: 1.2em; color: #00903a;">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="twitter" width="1em"
                                         height="1em" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M928 254.3c-30.6 13.2-63.9 22.7-98.2 26.4a170.1 170.1 0 0075-94 336.64 336.64 0 01-108.2 41.2A170.1 170.1 0 00672 174c-94.5 0-170.5 76.6-170.5 170.6 0 13.2 1.6 26.4 4.2 39.1-141.5-7.4-267.7-75-351.6-178.5a169.32 169.32 0 00-23.2 86.1c0 59.2 30.1 111.4 76 142.1a172 172 0 01-77.1-21.7v2.1c0 82.9 58.6 151.6 136.7 167.4a180.6 180.6 0 01-44.9 5.8c-11.1 0-21.6-1.1-32.2-2.6C211 652 273.9 701.1 348.8 702.7c-58.6 45.9-132 72.9-211.7 72.9-14.3 0-27.5-.5-41.2-2.1C171.5 822 261.2 850 357.8 850 671.4 850 843 590.2 843 364.7c0-7.4 0-14.8-.5-22.2 33.2-24.3 62.3-54.4 85.5-88.2z"></path>
                                    </svg>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/frycrypto" target="_blank"
                               style="font-size: 1.2em; padding-inline: 20px; color: #00903a">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="github" width="1em"
                                         height="1em" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M511.6 76.3C264.3 76.2 64 276.4 64 523.5 64 718.9 189.3 885 363.8 946c23.5 5.9 19.9-10.8 19.9-22.2v-77.5c-135.7 15.9-141.2-73.9-150.3-88.9C215 726 171.5 718 184.5 703c30.9-15.9 62.4 4 98.9 57.9 26.4 39.1 77.9 32.5 104 26 5.7-23.5 17.9-44.5 34.7-60.8-140.6-25.2-199.2-111-199.2-213 0-49.5 16.3-95 48.3-131.7-20.4-60.5 1.9-112.3 4.9-120 58.1-5.2 118.5 41.6 123.2 45.3 33-8.9 70.7-13.6 112.9-13.6 42.4 0 80.2 4.9 113.5 13.9 11.3-8.6 67.3-48.8 121.3-43.9 2.9 7.7 24.7 58.3 5.5 118 32.4 36.8 48.9 82.7 48.9 132.3 0 102.2-59 188.1-200 212.9a127.5 127.5 0 0138.1 91v112.5c.8 9 0 17.9 15 17.9 177.1-59.7 304.6-227 304.6-424.1 0-247.2-200.4-447.3-447.5-447.3z"></path>
                                    </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
<script type="text/javascript"  src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
@stack('scripts')
</body>
</html>
