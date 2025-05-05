<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;   
        margin: 0;
        overflow-y: hidden;
    }

    .top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        color: black;
        border-bottom: 2px solid #ddd;
        padding: 20px 180px;
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        z-index: 1000;
    }

    .top-bar-left {
        display: flex;
        align-items: center;
    }

    .menu-icon {
        font-size: 24px;
        cursor: pointer;
        margin-right: 0px;
        display: none;  
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo span {
        font-family: 'Times New Roman', Times, serif;
        font-size: 40px;
        font-weight: bold;
    }
    
    .top-bar img {
        height: 40px;
        width: 40px;
        margin-right: 10px;
    }

    .top-bar-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
        margin-right: -12px;
    }

    .right {
        position: relative;
        margin-right: 2px;
    }

    .top-bar-right .icon {
        font-size: 20px;
        cursor: pointer;
        position: relative;
        transition: transform 0.3s;
    }
    .top-bar-right .icon:hover {
        transform: translateY(-3px);
    }

    .top-bar-center {
        display: flex;
        gap: 30px;
        align-items: center;
        justify-content: center;
        flex: 1;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        color: black;
        font-size: 15px; 
        position: relative; 
        transition: color 0.3s ease;
    }

    .nav-links i {
        font-size: 20px;
    }

    .nav-links::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -35px;  
        height: 4px;
        width: 100%;
        background: #0a58ca;  
        transform: scaleX(0); 
        border-radius: 2px;
    }

    .nav-links:hover {
        color: #0a58ca;
    }

    .nav-links.active {
        color: #0a58ca;
    }

    .nav-links.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }
        
    @media screen and (max-width: 768px) {
        .top-bar-center {
            display: none; 
        }

        .top-bar {
            padding: 10px 15px;
        }
    }

  

    .content { 
        margin-left: 160px;
        padding: 20px;
        margin-top: 90px;    
        overflow: auto; 
        height: calc(100vh - 95px); 
        max-height: 100%;  
        box-sizing: border-box;  
        width: 100%;
    }

    @media (max-width: 1024px) {
        .content { 
            padding: 15px;
            width: 98%;
        }
    }

    @media (max-width: 768px) {
        .content {
            margin-left: 0;   
            margin-top: 50px;   
            height: calc(100vh - 50px);  
        }
    }

    @media (max-width: 480px) {
        .content {
            padding: 5px;      
            font-size: 14px;   
        }
    }


    @media (max-width: 1024px) { 
        .menu-icon {
            display: block;
        }
        .logo {
            display: none;
        }

        .logo span {
           display: none;
        }
    }

    @media (max-width: 768px) { 
        .logo {
            display: none;
        }

        .logo span {
           display: none;s
        } 
        .content {
            margin-left: 0;
        }

        .top-bar {
            padding: 10px;
        }
        .logo span {
            font-size: 24px;
        }
        .top-bar img {
            height: 30px;
            width: 30px;
        }

        .top-bar-right {
            gap: 10px;
            margin-right: 0;
        }
        .top-bar-right .icon {
            font-size: 20px;
        }
        .username {
            font-size: 14px;
            max-width: 100px;  
        }
    }

    @media (max-width: 480px) { 
        .logo {
            display: none;
        }

        .logo span {
           display: none;s
        }

        .top-bar-right {
            gap: 5px;
            margin-right: 0;
        }

        .top-bar-right .icon {
            font-size: 18px;
        }

        .username {
            font-size: 12px;
            max-width: 80px;
        }
    }
</style>
</head>
<body>
  
    <style>
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    
        .success_alert {
            position: fixed;
            top: -100px; 
            left: 50%;
            transform: translateX(-50%);
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border: 1px solid #c3e6cb;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: dropDown 0.5s ease-out forwards;
        }
    
        @keyframes dropDown {
            from {
                top: -100px;  
                opacity: 0;
            }
            to {
                top: 10px;  
                opacity: 1;
            }
        }
    
        .success_alert.hide {
            animation: moveUp 0.5s ease-out forwards;
        }
    
        @keyframes moveUp {
            from {
                top: 10px;
                opacity: 1;
            }
            to {
                top: -100px;
                opacity: 0;
            }
        }

        .error_alert {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border: 1px solid #f5c6cb;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: dropDown 0.5s ease-out forwards;
        }

        @keyframes dropDown {
            from {
                top: -100px;
                opacity: 0;
            }
            to {
                top: 10px;
                opacity: 1;
            }
        }

        .error_alert.hide {
            animation: moveUp 0.5s ease-out forwards;
        }

        @keyframes moveUp {
            from {
                top: 10px;
                opacity: 1;
            }
            to {
                top: -100px;
                opacity: 0;
            }
        }

    </style>
    @if(session('successs'))
    <div id="success-alert" class="success_alert">
        <strong></strong> {{ session('successs') }}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let alertBox = document.querySelector(".success_alert");
    
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.add("hide");  
                }, 3000);  
            }
        });
    </script>
    @endif
    

    <div class="top-bar">
        <div class="top-bar-left">
            <span class="menu-icon" onclick="toggleSidebar()">&#9776;</span>
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Company Logo">
                <span>Navi Cargo</span>
            </div>
        </div>

        <div class="top-bar-center">
            <a href="{{ route('home') }}" class="nav-links {{ Request::is('customer/pages/home') ? 'active' : '' }}">
                <i class='bx bx-home'></i> <span>Home</span>
            </a>
            <a href="{{ route('routes') }}" class="nav-links {{ Request::is('customer/pages/routes') ? 'active' : '' }}">
                <i class='bx bx-map'></i> <span>Routes</span>
            </a>
            <a href="{{ route('customer.pages.shipment_dashboard') }}" class="nav-links {{ Request::is('customer/pages/shipment_dashboard') ? 'active' : '' }}">
                <i class='bx bx-grid-alt'></i> <span>Dashboard</span>
            </a>
        </div>        
        
        <div class="top-bar-right">
            <span class="right icon" onclick="toggleNotification()">
                <i class="bx bxs-bell"></i>
                <span id="notification-badge" class="badge" style="display: none;"></span>
            </span>
        
            <span class="icon" onclick="toggleClaimStub()">
                <i class="fas fa-receipt"></i>
                <span id="claim-stub-badge" class="badge" style="display: none;"></span>
            </span>

            <div class="notification-wrapper">
                <div class="notification-panel" id="notification-panel">
                    <div class="panel-header">
                        <h3>Notification</h3>
                        <button class="close-btn" onclick="toggleNotification()">&#x2715;</button>
                    </div>
                
                    <div class="notification-content" id="notification-content">
                        <p>Loading Notification...</p>
                    </div>
                
                    <div class="panel-footer">
                        <a href="#" onclick="openRemoveModal()">Remove all Notification</a>
                    </div>                                    
                </div>

                <div class="claim-stub-panel" id="claim-stub-panel">
                    <div class="panel-header">
                        <h3>Claim Stub</h3>
                        <button class="close-btn" onclick="toggleClaimStub()">&#x2715;</button>
                    </div>
                
                    <div class="notification-content" id="claim-stub-content">
                        <p>Loading claim stubs...</p>
                    </div>
                
                    <div class="panel-footer">
                        <a href="#" onclick="openClaimStubModal()">Remove all Claim Stub</a>
                    </div>                    
                </div>                
            </div>
            
            <div class="dropdown">
                <button class="dropdown-toggle" id="dropdown-btn">
                    @if(Auth::check())
                        <span class="username">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
                    @else
                        <span class="username">Guest</span>  
                    @endif
                
                    <i class='bx bxs-user-circle'></i>  
                    <i class='bx bxs-down-arrow arrow'></i>
                </button>

                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="#" onclick="openLogoutModal()"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
            padding: 10px;
            display: flex;
            align-items: center;
            transition: background 0.3s, color 0.3s;
        }

        .dropdown-toggle {
            display: inline-flex;
            align-items: center;
            gap: 5px; 
            cursor: pointer;
            position: relative;
            padding: 5px 10px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .dropdown-toggle i {
            color: #000;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .dropdown-toggle .arrow {
            font-size: 8px; 
            margin-left: 5px;  
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
            transition: 0.3s;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 120px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            right: 0;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-menu i{
            margin-right: 5px;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            text-align: center;
            color: black;
            transition: background 0.3s;
        }

        .dropdown-menu a:hover {
            background: #f2f2f2;
        }

        .dropdown-menu.show {   
            display: block;
        }
    </style>

    <style>
        .new-notification {
            background-color: #f8d7da; 
            padding: 5px; 
        }

        .new-claim-stub {
            background-color: #f8d7da; 
            padding: 5px; 
        }
    </style>

    <style>
        .notification-wrapper {
            position: relative;
            z-index: 10000;
        }

        .badge {
            position: absolute;
            top: -9px;
            right: -5px;
            background-color: red;
            color: #fff;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
        }

        .notification-panel {
            position: fixed;
            top: 0;
            right: -350px;
            width: 320px;
            height: 100vh;
            background-color: #fff;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .claim-stub-panel {
            position: fixed;
            top: 0;
            right: -350px;
            width: 320px;
            height: 100vh;
            background-color: #fff;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .claim-stub-panel.active {
            right: 0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            padding: 12px 15px;
            background-color: #1877F2;
            color: #fff;
            font-weight: bold;
        }

        .panel-header h3 {
            text-transform: uppercase;
        }

        .close-btn {
            background-color: #fff;
            color: #1877F2;
            border: 2px solid #1877F2;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
        }

        .close-btn:hover {
            background-color: #1877F2;
            color: #fff;
        }

        .notification-content {
            padding: 0;
            flex-grow: 1;
            border-top: 1px solid #ccc;
            max-height: 400px;  
            overflow: auto; 
            max-height: 100%;  
        }
        
        .notification-content::-webkit-scrollbar {
            width: 6px;
        }

        .notification-content::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 10px;
        }

        .notification-content::-webkit-scrollbar-thumb {
            background: #888; 
            border-radius: 10px;
        }

        .notification-content::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }

        .notification-item {
            padding: 10px 15px;
            border-bottom: 1px solid #ccc;
            transition: background-color 0.2s ease;
        }

        .notification-item:hover {
            background-color: #e6f0ff;  
        }

        .notification-item p {
            margin: 0;
            font-weight: 500;
            color: #333;
            font-size: 13px;
        }

        .notification-item span {
            color: #777;
            font-size: 11px;
        }

        .panel-footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }

        .panel-footer a {
            text-decoration: none;
            color: #1877F2;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .panel-footer a:hover {
            color: #0d5bd7;  
            text-decoration: underline;
        }

        .notification-panel.active {
            right: 0;
        }

        @media (max-width: 768px) {
            .notification-panel,
            .claim-stub-panel {
                width: 100%; 
                right: -100%;  
            }

            .notification-panel.active,
            .claim-stub-panel.active {
                right: 0;  
            }

            .panel-header {
                padding: 10px 12px; 
                font-size: 1rem; 
            }

            .notification-item {
                padding: 8px 12px; 
            }

            .close-btn {
                width: 25px;
                height: 25px;
                font-size: 14px; 
            }
        }

        @media (max-width: 480px) {
            .notification-panel,
            .claim-stub-panel {
                width: 100%; 
                height: 100vh; 
                right: -100%;
            }

            .panel-header h3 {
                font-size: 0.9rem; 
            }

            .notification-item p {
                font-size: 0.85rem;  
            }

            .panel-footer a {
                font-size: 0.9rem;  
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationPanel = document.getElementById('notification-panel');
            const claimStubPanel = document.getElementById('claim-stub-panel');
            const claimStubModal = document.getElementById('claimStubModal');

            function togglePanel(panel) {
                if (panel.classList.contains('active')) {
                    panel.classList.remove('active');
                } else {
                    notificationPanel.classList.remove('active');
                    claimStubPanel.classList.remove('active');
                    panel.classList.add('active');
                }
            }

            document.querySelector('.icon[onclick="toggleNotification()"]').addEventListener('click', function (event) {
                event.stopPropagation();
                togglePanel(notificationPanel);
            });

            document.querySelector('.icon[onclick="toggleClaimStub()"]').addEventListener('click', function (event) {
                event.stopPropagation();
                togglePanel(claimStubPanel);
            });

            document.querySelectorAll('.close-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    notificationPanel.classList.remove('active');
                    claimStubPanel.classList.remove('active');
                    claimStubModal.style.display = "none";  
                });
            });

            document.addEventListener('click', function (event) {
                if (!notificationPanel.contains(event.target) && 
                    !claimStubPanel.contains(event.target) &&
                    !event.target.closest('.icon')) {
                    notificationPanel.classList.remove('active');
                    claimStubPanel.classList.remove('active');
                }

                if (claimStubModal.style.display === "block" && !claimStubModal.querySelector('.modal-content-stub').contains(event.target)) {
                    claimStubModal.style.display = "none";
                }
            });
        });
    </script>

    <style>
        .no-notifications {
            text-align: center;
            color: #777;
            font-size: 16px;
            font-weight: bold;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin: 10px auto;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const notificationContent = document.getElementById("notification-content");
            const notificationBadge = document.getElementById("notification-badge");
            const notificationIcon = document.querySelector(".icon[onclick='toggleNotification()']");
            let openedNotifications = new Set();  
 
            function fetchNotifications() {
                fetch('/notifications')
                    .then(response => response.json())
                    .then(data => {
                        notificationContent.innerHTML = '';  
                        let newNotifications = 0;

                        if (data.length === 0) {
                            notificationContent.innerHTML = '<p class="no-notifications">You have no notifications</p>';
                        } else {
                            data.forEach(notification => {
                                const item = document.createElement('div');
                                item.classList.add('notification-item');
 
                                if (notification.status === "new" && !openedNotifications.has(notification.id)) {
                                    item.classList.add("new-notification");
                                }

                                item.innerHTML = `
                                    <div>
                                        <p>${notification.message}</p>
                                        <span>${formatTime(notification.created_at)}</span>
                                    </div>
                                `;
                                notificationContent.appendChild(item);
                            });
 
                            data.forEach(notification => {
                                if (notification.status === "new") {
                                    openedNotifications.add(notification.id);
                                }
                            });

                            newNotifications = data.filter(n => n.status === "new").length;
                        }
 
                        notificationBadge.style.display = newNotifications > 0 ? "inline" : "none";
 
                        markNotificationsAsRead();
                    })
                    .catch(error => console.error('Error fetching notifications:', error));
            }
 
            function fetchNotificationCount() {
                fetch('/notifications')
                    .then(response => response.json())
                    .then(data => {
                        let newNotifications = data.filter(notification => notification.status === "new").length;
                        notificationBadge.textContent = newNotifications;
                        notificationBadge.style.display = newNotifications > 0 ? "inline" : "none";
                    })
                    .catch(error => console.error("Error fetching notification count:", error));
            }
 
            function markNotificationsAsRead() {
                fetch('/notifications/mark-as-read', {
                    method: "POST",
                    headers: { 
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(() => {
                    notificationBadge.style.display = "none";  
                })
                .catch(error => console.error("Error marking notifications as read:", error));
            }
 
            notificationIcon.addEventListener("click", function (event) {
                event.stopPropagation();
                fetchNotifications(); 
            });
 
            document.addEventListener("click", function (event) {
                if (!notificationContent.contains(event.target) && event.target !== notificationIcon) {
                    document.querySelectorAll('.new-notification').forEach(item => {
                        item.classList.remove('new-notification');
                    });
                }
            });

            function formatTime(timestamp) {
                const date = new Date(timestamp);
                return date.toLocaleString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            }
        
            fetchNotificationCount();
        });
    </script>

    <style>
        .stub-content {
            display: flex;
            justify-content: space-between;
            align-items: center; 
        }

        .view-button {
            background: linear-gradient(135deg, #2196F3, #1565C0);
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
        }

        .view-button:hover {
            background: #1565C0;
            transform: translateY(-2px);
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3);
        }

        .view-button:active {
            transform: scale(0.95);
            box-shadow: none;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const claimStubContent = document.getElementById("claim-stub-content");
            const claimStubBadge = document.getElementById("claim-stub-badge");
            const claimStubIcon = document.querySelector(".icon[onclick='toggleClaimStub()']");
            let openedStubs = new Set();

            function fetchClaimStubs() {
                fetch('/claim-stubs') 
                    .then(response => response.json())
                    .then(data => {
                        claimStubContent.innerHTML = '';
                        let newStubs = 0;

                        if (data.length === 0) {
                            claimStubContent.innerHTML = '<p class="no-notifications">You have no claim stub</p>';
                        } else {
                            data.forEach(stub => {
                                const item = document.createElement('div');
                                item.classList.add('notification-item');

                                if (stub.status === "new" && !openedStubs.has(stub.shipment_id)) {
                                    item.classList.add("new-claim-stub");
                                }

                                item.innerHTML = `
                                    <div class="stub-content">
                                        <div>
                                            <p class="shipment-id">Shipment Number: ${stub.shipment_id}</p> 
                                            <span>${formatTime(stub.created_at)}</span>
                                        </div>
                                        <button class="view-button" onclick="viewClaimStub('${stub.shipment_id}')">View</button>
                                    </div>
                                `;
                                claimStubContent.appendChild(item);
                            });

                            data.forEach(stub => {
                                if (stub.status === "new") {
                                    openedStubs.add(stub.shipment_id);
                                }
                            });

                            newStubs = data.filter(s => s.status === "new").length;
                        }

                        claimStubBadge.style.display = newStubs > 0 ? "inline" : "none";
                        markClaimStubsAsRead();
                    })
                    .catch(error => console.error('Error fetching claim stubs:', error));
            }

            function fetchClaimStubCount() {
                fetch('/claim-stubs') 
                    .then(response => response.json())
                    .then(data => {
                        let newStubs = data.filter(stub => stub.status === "new").length;
                        claimStubBadge.textContent = newStubs;
                        claimStubBadge.style.display = newStubs > 0 ? "inline" : "none";
                    })
                    .catch(error => console.error("Error fetching claim stub count:", error));
            }

            function markClaimStubsAsRead() {
                fetch('/claim-stubs/mark-as-read', { 
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(() => {
                    claimStubBadge.style.display = "none";
                })
                .catch(error => console.error("Error marking claim stubs as read:", error));
            }

            claimStubIcon.addEventListener("click", function (event) {
                event.stopPropagation();
                fetchClaimStubs();
            });

            document.addEventListener("click", function (event) {
                if (!claimStubContent.contains(event.target) && event.target !== claimStubIcon) {
                    document.querySelectorAll('.new-claim-stub').forEach(item => {
                        item.classList.remove('new-claim-stub');
                    });
                }
            });

            function formatTime(timestamp) {
                const date = new Date(timestamp);
                return date.toLocaleString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            }

            function viewClaimStub(shipmentId) {
                alert(`Viewing details for Shipment Number: ${shipmentId}`); 
            }

            fetchClaimStubCount();
        });
    </script>

        <div id="claimStubModal" class="modal">
            <div class="modal-content-stub"> 
                <button class="close-btn-stub" onclick="closeModalstub()">&#10006;</button>

                <div class="stub-header">
                    <div class="company-info">
                        <img src="{{ asset('img/logo.png') }}" alt="Company Logo" class="stub-logo">
                        <div class="company-name">Navi Cargo</div>
                    </div>
                    <div class="claim-title">Claim Stub</div>
                </div>

                <div class="stub-body">
                    <div class="stub-detail">
                        <p><strong>Shipment Number:</strong> <span id="modal-shipment-id"></span></p>
                    </div>
                    <div class="stub-detail">
                        <p><strong>First Name:</strong> <span id="modal-fname"></span></p>
                    </div>
                    <div class="stub-detail">
                        <p><strong>Last Name:</strong> <span id="modal-lname"></span></p>
                    </div>
                    <div class="stub-detail">
                        <p><strong>Phone Number:</strong> <span id="modal-phone"></span></p>
                    </div>
                    <div class="stub-detail">
                        <p><strong>Email:</strong> <span id="modal-email"></span></p>
                    </div> 
                    <div class="stub-detail">
                        <p><strong>Expected Delivery Date:</strong> <span id="modal-delivery-date"></span></p>
                    </div>
                </div>
        
                <div class="stub-footer">
                    <p><strong>&#128222; Customer Support:</strong> 
                        For assistance, call us at <span id="company-phone"></span>
                        or email <span id="company-email"></span>
                    </p>            
                    <p class="note"><strong>&#128233; Note:</strong> Please send this stub to your receiver.</p>
                    <p class="thank-you">Thank you for choosing Navi Cargo</p>
                </div>                
                <button class="print-btn" onclick="downloadModalContent()">Save</button>
            </div>
        </div> 

<script>
    function downloadModalContent() {
        const modal = document.querySelector(".modal-content-stub");
    
        let buttons = modal.querySelectorAll(".close-btn-stub, .print-btn, .download-btn");
        let originalBorder = modal.style.border;  
        modal.style.border = "none"; 
        buttons.forEach(button => button.style.visibility = "hidden");  

        html2canvas(modal, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL("image/png");
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF("p", "mm", "a4");
    
            const imgWidth = 210;  
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            doc.addImage(imgData, "PNG", 0, 0, imgWidth, imgHeight);
            doc.save("Claim_Stub.pdf");
    
            modal.style.border = originalBorder;
            buttons.forEach(button => button.style.visibility = "visible"); 
        });
    }
</script>

<style>
    .modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;  
        transform: translate(-50%, -50%);  
        border-radius: 8px; 
        z-index: 1000;
    }

    .modal-content-stub {
        width: 90%;
        max-width: 1000px;
        margin: 5% auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        font-family: 'Times New Roman', Times, serif;
        border: 2px solid #007bff;
        text-align: center;
        position: relative;
    }
 
    .close-btn-stub {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #007bff;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2em;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .close-btn-stub:hover {
        background: #0655aa;
    }
 
    .stub-header {
        display: flex;
        justify-content: space-between;  
        align-items: center;
        border-bottom: 2px solid #007bff; 
        padding: 10px 10px;
        padding-top: 40px;
    }
 
    .company-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
 
    .stub-logo {
        width: 38px;
        height: 38px;
    }
 
    .company-name {
        font-size: 1.8em;
        font-weight: bold;
        color: #000;
        font-family: 'Times New Roman', Times, serif; 
        margin-left: -5px;
    }
 
    .claim-title {
        font-size: 1.4em; 
        color: #333;
    }
 
    .stub-body {
        text-align: left;
        padding: 20px;
    }
 
    .stub-detail {
        margin: 14px 0;
        font-size: 1.2em;
        border-bottom: 1px dotted #ddd;
        padding-bottom: 8px;
    }
 
    .stub-footer {
        text-align: center; 
        font-size: 1em;
        color: #444;
        border-top: 2px solid #007bff;
        padding-top: 12px;
    }

    .stub-footer strong {
        color: #000;
    }

    .thank-you {
        font-size: 1.2em;
        font-weight: bold;
        margin-top: 10px;
        color: #007bff;
    }
 
    .print-btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 12px 25px;
        margin-top: 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1em;
    }

    .print-btn:hover {
        background: #0056b3;
    }

    @media screen and (max-width: 768px) {
        .modal {
            width: 95%;
        }

        .modal-content-stub {
            width: 100%;  
            max-width: 1000px;  
            padding: 15px;
            font-size: 1em;  
        }

        .stub-header {
            flex-direction: column;  
            text-align: center;
            padding-top: 20px;
        }

        .company-info {
            flex-direction: column;
            align-items: center;
        }

        .stub-logo {
            width: 50px;
            height: 50px;
        }

        .company-name {
            font-size: 1.5em;
        }

        .claim-title {
            font-size: 1.2em;
            margin-top: 5px;
        }

        .stub-body {
            padding: 10px;
        }

        .stub-detail {
            font-size: 1em;
            margin: 10px 0;
        }

        .stub-footer {
            font-size: 0.9em;
            padding-top: 10px;
        }

        .thank-you {
            font-size: 1em;
        }

        .close-btns {
            width: 25px;
            height: 25px;
            font-size: 1em;
        }

        .print-btn {
            width: 100%;
            padding: 10px;
            font-size: 1em;
        }
    }

    @media screen and (max-width: 480px) {
        .modal-content-stub {
            width: 100%;
            max-width: 800px;
            font-size: 0.9em;  
        }

        .stub-logo {
            width: 40px;
            height: 40px;
        }

        .company-name {
            font-size: 1.3em;
        }

        .claim-title {
            font-size: 1em;
        }

        .stub-detail {
            font-size: 0.9em;
        }

        .stub-footer {
            font-size: 0.8em;
        }

        .print-btn {
            font-size: 0.9em;
        }
    }
</style>

<script>
    function viewClaimStub(shipmentId) {
        fetch(`/claim-stubs/${shipmentId}`)
            .then(response => response.json())
                .then(data => { 
                    document.getElementById("modal-shipment-id").textContent = data.shipment_id;
                    document.getElementById("modal-fname").textContent = data.fname;
                    document.getElementById("modal-lname").textContent = data.lname;
                    document.getElementById("modal-phone").textContent = data.phone;
                    document.getElementById("modal-email").textContent = data.email;

                    const dates = data.expected_delivery_date.split(' - ');
                    const formattedStartDate = formatDate(dates[0]);
                    const formattedEndDate = formatDate(dates[1]);
                    document.getElementById("modal-delivery-date").textContent = `${formattedStartDate} - ${formattedEndDate}`;

                    document.getElementById("company-phone").textContent = data.company_phone;
                    document.getElementById("company-email").textContent = data.company_email;

                    document.getElementById("claimStubModal").style.display = "block";
                })
            .catch(error => console.error("Error fetching claim stub details:", error));
        }

    
    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    function closeModalstub() {
        document.getElementById("claimStubModal").style.display = "none";
    }
</script>

 
    



    <div class="modal-new" id="removeNotificationModal">
        <div class="modal-content-new">
            <h2>Are you sure?</h2>
            <p>This will remove all notifications permanently.</p>
            <div class="modal-buttons-new">
                <button class="confirm-btn-new" onclick="confirmRemoveNotifications()">Yes, Remove</button>
                <button class="cancel-btn-new" onclick="closeRemoveModal()">Cancel</button>
            </div>
        </div>
    </div>
    <script>
        function openRemoveModal() {
            fetch('/notifications')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        const alertBox = document.createElement("div");
                        alertBox.className = "error_alert";
                        alertBox.innerHTML = `No Notification Exist`;
                        document.body.appendChild(alertBox);
        
                        setTimeout(() => {
                            alertBox.classList.add("hide");
                            setTimeout(() => alertBox.remove(), 500);
                        }, 3000);
        
                        return;
                    }
        
                    let modal = document.getElementById("removeNotificationModal");
                    if (modal) {
                        modal.style.display = "block";
                        setTimeout(() => modal.classList.add("show"), 10);
                    }
                })
                .catch(error => {
                    console.error("Error fetching notifications:", error);
                });
        }
        
        function closeRemoveModal() {
            let modal = document.getElementById("removeNotificationModal");
            if (modal) {
                modal.classList.remove("show");
                setTimeout(() => {
                    modal.style.display = "none";
                    modal.setAttribute("aria-hidden", "true");
                }, 300);
            }
        }

        function confirmRemoveNotifications() {
            fetch('/notifications/remove-all', {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) { 
                    closeRemoveModal();   

                    document.getElementById("notification-content").innerHTML = "<p>No new notifications</p>";
                    let badge = document.getElementById("notification-badge");
                    if (badge) badge.style.display = "none";

                    showAlert(data.success, "success");   
                } else if (data.error) {
                    showAlert(data.error, "error");  
                } else {
                    console.error("Error: Unexpected response");
                }
            })
            .catch(error => console.error("Error removing notifications:", error));
        }

        function showAlert(message, type) {
            let alertClass = type === "success" ? "success_alert" : "error_alert";

            let oldAlert = document.getElementById("custom-alert");
            if (oldAlert) oldAlert.remove();

            let alertDiv = document.createElement("div");
            alertDiv.id = "custom-alert";
            alertDiv.className = alertClass;
            alertDiv.innerHTML = `<strong></strong> ${message}`;
            
            alertDiv.style.pointerEvents = "none"; 

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.add("hide");
                setTimeout(() => alertDiv.remove(), 500);
            }, 3000);
        }
    </script>

    <div class="modal-new" id="removeClaimStubModal">
        <div class="modal-content-new">
            <h2>Are you sure?</h2>
            <p>This will remove all claim stubs permanently.</p>
            <div class="modal-buttons-new">
                <button class="confirm-btn-new" onclick="confirmRemoveClaimStubs()">Yes, Remove</button>
                <button class="cancel-btn-new" onclick="closeClaimStubModal()">Cancel</button>
            </div>
        </div>
    </div>
   <script>
        function openClaimStubModal() {
            fetch('/claim-stubs')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        const alertBox = document.createElement("div");
                        alertBox.className = "error_alert";
                        alertBox.innerHTML = `No Claim Stub Exist`;
                        document.body.appendChild(alertBox);

                        setTimeout(() => {
                            alertBox.classList.add("hide");
                            setTimeout(() => alertBox.remove(), 500);
                        }, 3000);

                        return;
                    }

                    let modal = document.getElementById("removeClaimStubModal");
                    if (modal) {
                        modal.style.display = "block";
                        setTimeout(() => modal.classList.add("show"), 10);
                    }
                })
                .catch(error => {
                    console.error("Error fetching claim stubs:", error);
                });
        }

        function closeClaimStubModal() {
            let modal = document.getElementById("removeClaimStubModal");
            if (modal) {
                modal.classList.remove("show");
                setTimeout(() => {
                    modal.style.display = "none";  
                    modal.setAttribute("aria-hidden", "true");  
                }, 300);
            }
        }

        function confirmRemoveClaimStubs() {
            fetch('/claimstubs/remove-all', {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) { 
                    closeClaimStubModal();   

                    document.getElementById("claim-stub-content").innerHTML = "<p>No claim stubs available</p>";
                    showAlert(data.success, "success");
                } else if (data.error) {
                    showAlert(data.error, "error");  
                } else {
                    console.error("Error: Unexpected response");
                }
            })
            .catch(error => console.error("Error removing claim stubs:", error));
        }

        function showAlert(message, type) {
            let alertClass = type === "success" ? "success_alert" : "error_alert";

            let oldAlert = document.getElementById("custom-alert");
            if (oldAlert) oldAlert.remove();

            let alertDiv = document.createElement("div");
            alertDiv.id = "custom-alert";
            alertDiv.className = alertClass;
            alertDiv.innerHTML = `<strong></strong> ${message}`;
            
            alertDiv.style.pointerEvents = "none"; 

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.add("hide");
                setTimeout(() => alertDiv.remove(), 500);
            }, 3000);
        }
   </script>



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
    <div id="logout-modal" class="modal-new">
        <div class="modal-content-new">
            <h3>Are you sure you want to log out?</h3>
            <div class="modal-buttons-new">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="confirm-btn-new">Logout</button>
                </form>
                <button onclick="closeLogoutModal()" class="cancel-btn-new">Cancel</button>
            </div>
        </div>  
    </div>
    <script>
        function openLogoutModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.add('show');
        }
    
        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.remove('show');
        }
    </script>
    
    

 
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-title">MENU</span>
                <span class="sidebar-close" onclick="closeSidebar()">&times;</span>
            </div>
            <ul class="sidebar-links">
                <li>
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('customer/pages/home') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('routes') }}" class="nav-link {{ Request::is('customer/pages/routes') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt"></i> Routes
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.pages.shipment_dashboard') }}" class="nav-link {{ Request::is('customer/pages/shipment_dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-backdrop" onclick="closeSidebar()"></div>

        <style> 
            .sidebar,
            .sidebar-backdrop {
                display: none;
            }
            
            .menu-icon {
                display: none;
                font-size: 2rem;
                cursor: pointer;
                margin-left: 10px;
                z-index: 1101;
            }
            
            @media (max-width: 900px) {
                .menu-icon {
                    display: inline-block;
                }
                .sidebar {
                    display: flex;
                    flex-direction: column;
                    position: fixed;
                    top: 0;
                    left: -260px;
                    width: 220px;
                    height: 100vh;
                    background: #fff;
                    box-shadow: 2px 0 16px rgba(99,102,241,0.13);
                    z-index: 1100;
                    transition: left 0.3s cubic-bezier(.77,0,.18,1);
                    border-radius: 0 12px 12px 0;
                    overflow-y: auto;
                }
                .sidebar.open {
                    left: 0;
                }
                .sidebar-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 18px 20px 10px 20px;
                    border-bottom: 1px solid #eee;
                    background: #f0f0f0;
                }
                .sidebar-title {
                    font-size: 1.1em;
                    color: #000;
                    font-weight: bold;
                    letter-spacing: 1px;
                }
                .sidebar-close {
                    font-size: 2rem;
                    cursor: pointer;
                    color: #888;
                    margin-left: 10px;
                    transition: color 0.2s;
                }
                .sidebar-close:hover {
                    color: #0a58ca;
                }
                .sidebar-links {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }
                .sidebar-links li {
                    border-bottom: 1px solid #eee;
                }
                .sidebar-links a {
                    display: flex;
                    align-items: center;
                    padding: 16px 20px;
                    text-decoration: none;
                    color: #181818;
                    font-weight: 500;
                    border-left: 3px solid transparent;
                    border-radius: 4px;
                    transition: background 0.3s, border-left 0.3s, color 0.2s;
                    font-size: 1rem;
                }
                .sidebar-links a i {
                    margin-right: 10px;
                    font-size: 1.1em;
                }
                .sidebar-links a:hover,
                .sidebar-links a.active { 
                    background: #f5f7ff;
                    color: #0a58ca;
                }
                .sidebar-backdrop {
                    display: none;
                    position: fixed;
                    top: 0; left: 0; width: 100vw; height: 100vh;
                    background: rgba(0,0,0,0.18);
                    z-index: 1099;
                }
                .sidebar.open ~ .sidebar-backdrop {
                    display: block;
                }
            }
        </style>

        <script>
            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('open');
                document.querySelector('.sidebar-backdrop').style.display =
                    document.getElementById('sidebar').classList.contains('open') ? 'block' : 'none';
            }
            function closeSidebar() {
                document.getElementById('sidebar').classList.remove('open');
                document.querySelector('.sidebar-backdrop').style.display = 'none';
            }
        </script>

            
    

    <div class="content">
        @yield('content')
    </div>
 

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }
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
</body>
</html>
