<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f8f9fa;
        overflow: hidden;
    }

    .container {
        display: flex;
    }

    .sidebar {
        width: 240px;
        background-color: #081526;
        padding: 20px;
        border-right: 1px solid #e0e0e0;
        position: fixed;
        height: 100vh;
        color: #fff;
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .sidebar nav ul {
        list-style-type: none;
    }

    .sidebar nav ul li {
        margin-bottom: 15px;
    }

    .sidebar nav ul li a i {
        margin-right: 10px;
    }

    .sidebar nav ul li a i {
        margin-right: 10px;
        min-width: 20px;  
    }

    .sidebar nav ul li a {
        text-decoration: none;
        color: #ffffff;
        display: flex;
        margin-top: -13px;
        align-items: center;
        transition: background-color 0.3s, color 0.3s, padding-left 0.3s;
        padding: 5px 10px;
        border-radius: 5px;
        padding-right: 35px;
    }

    .sidebar nav ul li a:hover {
        background-color: #17375a;  
        color: #ffffff;             
    }

    .sidebar nav ul li a.active {
        background-color: #fff;  
        color: #000;             
    }

    .sidebar h4 {
        margin-top: 20px;
        margin-bottom: 10px;
        color: #fff;
        font-size: 14px;
    }

    .main {
        margin-left: 240px;
        padding: 20px;
        width: calc(100% - 240px);
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 50px;
        border-bottom: 2px solid #ddd;
        background-color: #fff;
        padding: 15px;
        top: 0;
        right: 0;
        left: 240px;    
        position: fixed;
        z-index: 100;
    }

    .search-bar {
        padding: 8px 12px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
    }

    .icons i {
        font-size: 20px;
        margin-left: 20px;
        cursor: pointer;
        color: #555;
    }
 
    .logo {
        display: flex;
        align-items: center;
    }
    .logo span {
        font-family: 'Times New Roman', Times, serif;
        font-size: 30px;
        font-weight: bold;
    }
    .logo img {
        height: 35px;
        width: 35px;
        margin-right: 10px;
    }

 
 
    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            left: -240px;
            z-index: 10000;
            transition: left 0.3s;
        }

        .sidebar.active {
            left: 0;
        }

        .top-bar {
            left: 0;
        }

        .main {
            margin-left: 0;
            width: 100%;
            padding: 15px;
        }

        .search-bar {
            width: 200px;
            margin-left: 40px;
        }

        .content {
            margin-top: -90px;
        }

        .logo {
            margin-top: 6px;
        }
        
        .username {
            font-size: 12px;
            max-width: 80px;
        }
    }

    @media (max-width: 576px) {
        .search-bar {
            width: 150px;
        }

        .icons i {
            font-size: 18px;
        }

        .logo span {
            font-size: 20px;
        }

        .username {
            font-size: 12px;
            max-width: 80px;
        }
    }

    .menu-toggle {
        display: none;
        font-size: 24px;
        cursor: pointer;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 110;
        color: #333;
    }

    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
        }
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 90;
    }

    .overlay.active {
        display: block;
    }
</style>

</head>
<body>

    <style>
        .sidebar-close {
            display: none;
            position: absolute;
            top: 18px;
            right: 18px;
            background: none;
            border: none;
            font-size: 2rem;
            color: #fff;
            cursor: pointer;
            z-index: 201;
            transition: color 0.2s;
        }
        .sidebar-close:hover {
            color: #f44336;
        }
        @media (max-width: 900px) {
            .sidebar-close {
                display: block;
            }
        }
    </style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');
        const sidebarClose = document.getElementById('sidebar-close');

        if (sidebarClose) {
            sidebarClose.addEventListener('click', function () {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    });
</script>

<div class="menu-toggle">
    <i class="fas fa-bars"></i>
</div>

<div class="overlay"></div>

<div class="container">
    <aside class="sidebar">
        <button class="sidebar-close" id="sidebar-close" aria-label="Close sidebar">&times;</button>
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Company Logo">
            <span>Navi Cargo</span>
        </div>
        <nav> 
            <ul>
                <li>
                    <a href="{{ route('admin.pages.dashboard') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('admin/pages/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
            </ul>

            <h4>SHIPMENTS</h4>
            <ul>
                <li> <a href="{{ route('admin.pages.shipments.submitted_request') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('admin/pages/shipments/submitted_request') ? 'active' : '' }}">
                        <i class="fas fa-box-open"></i> Request 
                    </a>
                </li>
                <li> <a href="{{ route('admin.pages.shipments.queued') }}" class="nav-link {{ Request::is('admin/pages/shipments/queued') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i> Queued
                    </a>
                </li>
                <li> <a href="{{ route('admin.pages.shipments.in_transit') }}" class="nav-link {{ Request::is('admin/pages/shipments/in_transit') ? 'active' : '' }}">
                        <i class="fas fa-shipping-fast"></i> In Transit  
                    </a>
                </li>
                <li> <a href="{{ route('admin.pages.shipments.dispatched') }}" class="nav-link {{ Request::is('admin/pages/shipments/dispatched') ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i> Dispatched 
                    </a>
                </li>
                <li> <a href="{{ route('admin.pages.shipments.claimed') }}" class="nav-link {{ Request::is('admin/pages/shipments/claimed') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check"></i> Claimed 
                    </a>
                </li>
                <li> <a href="{{ route('admin.pages.shipments.unclaim') }}" class="nav-link {{ Request::is('admin/pages/shipments/unclaim') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Unclaim
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.shipments.cancelled') }}" class="nav-link {{ Request::is('admin/pages/shipments/cancelled') ? 'active' : '' }}">
                        <i class="fas fa-times-circle"></i> Cancelled 
                    </a>
                </li>
            </ul>

            <h4>ACCOUNTS</h4>
            <ul>
                <li>
                    <a href="{{ route('admin.pages.accounts.teller') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('admin/pages/accounts/teller') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i> Manage Teller 
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.accounts.user') }}" class="nav-link {{ Request::is('admin/pages/accounts/user') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Manage User  
                    </a>
                </li>
            </ul>

            <h4>RATES & CATEGORIES</h4>
            <ul>
                <li>
                    <a href="{{ route('admin.pages.rates.rates') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('admin/pages/rates/rates') ? 'active' : '' }}">
                        <i class="fas fa-ship"></i> Shipping Rates 
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.rates.categories') }}" class="nav-link {{ Request::is('admin/pages/rates/categories') ? 'active' : '' }}">
                        <i class="fas fa-th-list"></i> Categories
                    </a>
                </li>
            </ul>

            <h4>COMPANY</h4>
            <ul>
                <li>
                    <a href="{{ route('admin.pages.company.contact_details') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('admin/pages/company/contact_details') ? 'active' : '' }}">
                        <i class="fas fa-phone-alt"></i>Contact Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pages.company.branch') }}" class="nav-link {{ Request::is('admin/pages/company/branch') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt"></i>Branches
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="main">
            <div class="top-bar">
                <div class="search-container">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" class="search-input" id="search1" oninput="search()" placeholder="Search..." />
                    <span class="clear-btn" onclick="clearSearch()">✖</span>
                </div>
        <div class="icons"> 
                <div class="dropdown">
                    <button class="dropdown-toggle" id="dropdown-btn">
                        <span class="username">Administrator</span>    
                        <i class="fas fa-user-circle"></i>  
                        <i class='bx bxs-down-arrow arrow'></i>
                    </button>
                
                    <div class="dropdown-menu" id="dropdown-menu">
                        <a href="#" onclick="openLogoutModalNew()"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div> 
                </div>
            </div>
        </div>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-toggle {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        transition: background 0.3s, color 0.3s, box-shadow 0.3s;
        border-radius: 5px;
    }

    .dropdown-toggle i {
        color: #000;
        font-size: 24px;
        transition: color 0.3s ease;
        margin-left: 5px;
    }

    .dropdown-toggle .arrow {
        font-size: 10px;  
        margin-left: 10px;  
        vertical-align: middle;  
    }

    .username {
        color: #000;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.3s ease;
    }

    .dropdown-toggle:hover { 
        color: #333;
    }

    .dropdown-toggle::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background: #333;
        transition: width 0.3s ease;
    }

    .dropdown-toggle:hover::after {
        width: 100%;
    }

    .dropdown-toggle .arrow-down {
        margin-left: 5px;
        border: solid black;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 4px;
        transform: rotate(45deg);
        transition: transform 0.3s;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 150px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        right: 0;
        border-radius: 5px;
        overflow: hidden;
        transition: opacity 0.3s, transform 0.3s;
        opacity: 0;
        transform: translateY(-10px);
    }

    .dropdown-menu.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-menu i {
        margin-right: 5px;
        transition: color 0.3s;
        color: #000;
    }

    .dropdown-menu a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        text-align: left;
        color: #000;
        transition: background 0.3s, color 0.3s;
    }

    .dropdown-menu a:hover {
        background: #f2f2f2;
        color: #000;
    }

    .dropdown-menu a i:hover {
        color: #000;
    }

</style>



<style>
    .modal-new {
        display: none;
        position: fixed;
        top: 0; 
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4); 
        backdrop-filter: blur(0px);
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .modal-new.show {
        display: block;
        opacity: 1; 
    }

    .modal-content-new {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 30px;
        width: 90%;
        max-width: 400px;
        margin: 15% auto;
        text-align: center;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        transform: scale(0.9);
        opacity: 0;
        animation: modalOpen 0.3s ease-out forwards;
    }

    @keyframes modalOpen {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .modal-content-new.close {
        animation: modalClose 0.3s ease-in forwards;
    }

    @keyframes modalClose {
        from {
            transform: scale(1);
            opacity: 1;
        }
        to {
            transform: scale(0.9);
            opacity: 0;
        }
    }

    .modal-buttons-new {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .confirm-btn-new, .cancel-btn-new {
        padding: 10px 25px;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .confirm-btn-new {
        background: linear-gradient(135deg, #2196F3, #1565C0); 
        color: #fff;
        box-shadow: 0 4px 10px rgba(33, 150, 243, 0.5);
        border: none;
        padding: 10px 30px;
        border-radius: 30px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .confirm-btn-new:hover {
        background: #1565C0;
        box-shadow: 0 6px 15px rgba(33, 150, 243, 0.8);
        transform: translateY(-2px);
    }

    .cancel-btn-new {
        background: linear-gradient(135deg, #F44336, #C62828);
        color: #fff;
        box-shadow: 0 4px 10px rgba(244, 67, 54, 0.5);
    }

    .cancel-btn-new:hover {
        background: #C62828;
        box-shadow: 0 6px 15px rgba(244, 67, 54, 0.8);
        transform: translateY(-2px);
    }
</style>

<div id="logout-modal-new" class="modal-new">
    <div class="modal-content-new">
        <h3>Are you sure you want to log out?</h3>
        <div class="modal-buttons-new">
            <form id="logout-form-new" action="{{ route('admin_logout') }}" method="POST">
                @csrf
                <button type="submit" class="confirm-btn-new">Logout</button>
            </form>            
            <button onclick="closeLogoutModalNew()" class="cancel-btn-new">Cancel</button>
        </div>
    </div>  
 </div> 

<script>
    function openLogoutModalNew() {
        document.getElementById("logout-modal-new").classList.add("show");
    }

    function closeLogoutModalNew() {
        document.getElementById("logout-modal-new").classList.remove("show");
    }

    document.getElementById("logout-modal-new").addEventListener("click", closeLogoutModalNew);

   document.addEventListener("keydown", function(event) {
       const modal = document.getElementById("logout-modal-new");
       if (modal.style.display === "flex") {  
           if (event.key === "Enter") {
               document.getElementById("logout-form-new").submit();
           } else if (event.key === "Escape") {
               closeLogoutModalNew();
           }
       }
   });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtn = document.getElementById("dropdown-btn");
        const dropdownMenu = document.getElementById("dropdown-menu");

        dropdownBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function (event) {
            if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        });
    });
    </script>
            

    <div>
        @yield('add')
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
</div>
 
<style>
    .search-container {
        position: relative;
        width: 100%;
        max-width: 350px;
        display: flex;
        align-items: center;
        border-radius: 25px;
        background-color: #fff;
        border: 1px solid #dcdcdc;
        box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
        padding: 0 12px;
        margin: 0 10px;
        transition: box-shadow 0.3s ease;
    }

    .search-container:focus-within {
        box-shadow: 0 1px 6px rgba(60, 64, 67, 0.3), 0 0 0 1px rgba(60, 64, 67, 0.3);
    }

    .search-icon {
        font-size: 18px;
        color: #5f6368;
        margin-right: 10px;
    }

    .search-input {
        flex: 1;
        padding: 10px 10px 10px 0;
        font-size: 16px;
        border: none;
        outline: none;
        background: transparent;
        color: #202124;
    }

    .clear-btn {
        font-size: 16px;
        color: #5f6368;
        cursor: pointer;
        display: none;
        transition: color 0.2s;
    }

    .clear-btn:hover {
        color: #3c4043;
    }

    @media (max-width: 768px) {
        .search-container {
            max-width: 100px;
            padding: 0 8px;
            left: 30px;
        }

        .search-input {
            font-size: 14px;
        }

        .search-icon {
            font-size: 16px;
            margin-left: 10px;
        }

        .clear-btn {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .search-container {
            max-width: 50%;
            padding: 0 4px;
            left: 30px;
        }

        .search-input {
            font-size: 12px;
        }

        .search-icon {
            font-size: 14px;
            margin-left: 10px;
        }

        .clear-btn {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .topbar {
            flex-wrap: wrap;
            height: auto;
            left: 0;
        }

        .add a {
            width: 30%;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .topbar {
            align-items: center;
            text-align: center;
            left: 0;
        }

        .add a {
            width: 30%;
        }
    }
</style>
<script>
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.overlay');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
</script>

</body>
</html>
