@php
use Illuminate\Support\Facades\Request;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/insight logo.png" type="image/x-icon">
    <title>CMS Ticket Sale Appli</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/assets/bootstrap-5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/flatpickr.min.css">

    <!-- JavaScript -->
    <script src="/assets/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/flatpickr.js"></script>
    <script src="/assets/js/custom-calendar.js"></script>
    <script src="/assets/js/chart.js"></script>
    <script src="/assets/js/lineChart.js"></script>
    <script src="/assets/js/pieChart.js"></script>
    <script src="/assets/js/main.js"></script>

    <!-- main -->
    <link rel="stylesheet" href="/assets/css/main.css">

</head>

<body>
    <aside>
        <a href="{{ route('HomePage') }}"><img src="/assets/images/insight logo.png" alt="logo" class="logo"></a>
        <div class="menu">
            <ul class="">
                <li>
                    <a href="{{ route('HomePage') }}" class="menu-link {{ Request::is('/') ? 'active' : '' }}">
                        <img src="/assets/images/icons/Vector.svg" alt="">
                        Trang chủ
                    </a>
                </li>
                <li>
                    <a href="{{ route('TicketManagementPage') }}"
                        class="menu-link {{ Request::is('ticket-management*') ? 'active' : '' }}">
                        <img src="/assets/images/icons/Vector-1.svg" alt="">
                        Quản lý vé
                    </a>
                </li>
                <li>
                    <a href="{{ route('TicketReconciliationPage') }}"
                        class="menu-link {{ Request::is('ticket-reconciliation*') ? 'active' : '' }}">
                        <img src="/assets/images/icons/Vector-2.svg" alt="">
                        Đối soát vé
                    </a>
                </li>
                <li>
                    <a href="{{ route('EventListPage') }}"
                        class="menu-link {{ Request::is('event-list*') ? 'active' : '' }}">
                        <img src="/assets/images/icons/Vector-3.svg" alt="">
                        Danh sách sự kiện
                    </a>
                </li>
                <li>
                    <a href="{{ route('DeviceManagementPage') }}"
                        class="menu-link {{ Request::is('device-management*') ? 'active' : '' }}">
                        <img src="/assets/images/icons/Vector-4.svg" alt="">
                        Quản lý thiết bị
                    </a>
                </li>
                <li>
                    <button class="menu-link" data-bs-toggle="collapse" data-bs-target="#setting-collapse"
                        aria-expanded="true">
                        <img src="/assets/images/icons/Vector-5.svg" alt="">Cài đặt
                    </button>
                    <div class="collapse show" id="setting-collapse">
                        <ul class="">
                            <li>
                                <a href="{{ route('ServicesPage') }}"
                                    class="menu-link {{ Request::is('services*') ? 'active' : '' }}">
                                    Gói dịch vụ
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="copyright">
            <span>Copyright &#169; 2020 Alta Software</span>
        </div>
    </aside>
    <main>
        <nav>
            <form action="" method="get" class="search">
                <input type="search" name="search" id="" placeholder="Search">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <div class="notification-message-user">
                <i class="fa-regular fa-envelope"></i>
                <i class="fa-regular fa-bell"></i>
                <div class="avatar">
                    <img src="/assets/images/avatars/4e060bd1ec00e99dad7bb8a684411209.jpg" alt="">
                </div>
            </div>
        </nav>
        <article>
            @yield('HomePage')
            @yield('TicketManagementPage')
            @yield('TicketReconciliationPage')
            @yield('EventListPage')
            @yield('DeviceManagementPage')
            @yield('ServicesPage')
        </article>
    </main>
</body>

</html>