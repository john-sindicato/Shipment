<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7fa;
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
        margin-top: -8px;
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
        z-index: 10;
    }

    .search-bar {
        padding: 8px 12px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
    }

    .icons {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: nowrap;
    }
    
    .icons .icon {
        font-size: 24px;
        cursor: pointer;
        position: relative;
        transition: transform 0.3s, font-size 0.3s;
    }
    
    @media (min-width: 1024px) {
        .icons .icon {
            font-size: 26px;
        }
    }
    
    @media (max-width: 768px) {
        .icons {
            gap: 4px;
        }

        .icons .icon {
            font-size: 22px;
        }
    }
    
    @media (max-width: 480px) {
        .icons {
            gap: 5px;
            justify-content: center;
        }

        .icons .icon {
            font-size: 20px;
        }
    }

    .icons .icon:hover {
        transform: translateY(-3px);
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
            z-index: 100;
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

        .dropdown-toggle i {
            font-size: 18px;
        }
    }

    .menu-toggle {
        display: none;
        font-size: 24px;
        cursor: pointer;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 100;
        color: #333;
    }

    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
            z-index: 100;
        }

        .menu-toggle i {
            z-index: 0;
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
    @if(session('error_message'))
        <div id="error-alert" class="error_alert">
            <strong>Error:</strong> {{ session('error_message') }}
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let errorAlertBox = document.querySelector(".error_alert");
    
                if (errorAlertBox) {
                    setTimeout(() => {
                        errorAlertBox.classList.add("hide");  
                    }, 3000);  
                }
            });
        </script>
    @endif

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
    @if(session('success1'))
    <div id="success-alert" class="success_alert">
        <strong></strong> {{ session('success1') }}
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
                    <a href="{{ route('teller.pages.dashboard') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('teller/pages/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
            </ul>
            <h4>SHIPMENTS</h4>
            <ul>
                <li> <a href="{{ route('teller.pages.request') }}" style="margin-top: 3px;" class="nav-link {{ Request::is('teller/pages/request') ? 'active' : '' }}">
                        <i class="fas fa-box-open"></i> Request 
                    </a>
                </li>
                <li> <a href="{{ route('teller.pages.approved') }}" class="nav-link {{ Request::is('teller/pages/approved') ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i> Approved 
                    </a>
                </li>
                <li> <a href="{{ route('teller.pages.queued') }}" class="nav-link {{ Request::is('teller/pages/queued') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i> Queued
                    </a>
                </li>
                <li>
                    <a href="{{ route('teller.pages.in_transit') }}" class="nav-link {{ Request::is('teller/pages/in_transit') ? 'active' : '' }}">
                        <i class="fas fa-shipping-fast"></i> In Transit 
                    </a>
                </li>
                <li>
                    <a href="{{ route('teller.pages.dispatched') }}" class="nav-link {{ Request::is('teller/pages/dispatched') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check"></i> Dispatched
                    </a>
                </li>
                <li>
                    <a href="{{ route('teller.pages.claimed') }}" class="nav-link {{ Request::is('teller/pages/claimed') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check"></i> Claimed
                    </a>    
                </li>
                <li>
                    <a href="{{ route('teller.pages.unclaimed') }}" class="nav-link {{ Request::is('teller/pages/unclaimed') ? 'active' : '' }}">
                        <i class="fas fa-archive"></i> Unclaim
                    </a>
                </li>
                <li>
                    <a href="{{ route('teller.pages.declined') }}" class="nav-link {{ Request::is('teller/pages/declined') ? 'active' : '' }}">
                        <i class="fas fa-times-circle"></i> Declined
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
                <span class="icon" onclick="toggleMessage()">
                    <i class="fas fa-comment-alt"></i>
                    <span id="message-badge" class="badge" style="display: none;"></span>
                </span>
 
                <div class="message-wrapper">
                    <div class="message-panel" id="message-panel">
                        <div class="panel-header">
                            <h3>Messages</h3>
                            <button class="close-btns" onclick="toggleMessage()">&#x2715;</button>
                        </div>
                
                        <div class="message-content" id="message-content">
                            <p>Loading Messages...</p>
                        </div>
                
                        <div class="panel-footer">
                            <a href="#" onclick="openRemoveModal()">Remove all Messages</a>
                        </div>                                    
                    </div>
                </div>
 
                <style>
                    .message-wrapper {
                        position: relative;
                        z-index: 99999;
                    }

                    .badge {
                        position: absolute;
                        top: -5px;
                        right: -5px;
                        background-color: red;
                        color: #fff;
                        border-radius: 30%;
                        padding: 3px 6px;
                        font-size: 12px;
                    }

                    .message-panel {
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

                    .panel-header {
                        display: flex;
                        justify-content: space-between;
                        padding: 12px 15px;
                        background-color: #081526;
                        color: #fff;
                        font-weight: bold;
                    }

                    .panel-header h3 {
                        text-transform: uppercase;
                    }

                    .close-btns {
                        background-color: #fff;
                        color: #081526;
                        border: 2px solid #081526;
                        border-radius: 50%;
                        width: 30px;
                        height: 30px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: pointer;
                        font-weight: bold;
                    }

                    .close-btns:hover {
                        background-color: #081526;
                        color: #fff;
                    }

                    .message-content {
                        padding: 0;
                        flex-grow: 1;
                        border-top: 1px solid #ccc;
                        max-height: 400px;  
                        overflow: auto; 
                        max-height: 100%;  
                    }

                    .message-content::-webkit-scrollbar {
                        width: 6px;
                    }

                    .message-content::-webkit-scrollbar-track {
                        background: #f1f1f1; 
                        border-radius: 10px;
                    }

                    .message-content::-webkit-scrollbar-thumb {
                        background: #888; 
                        border-radius: 10px;
                    }

                    .message-content::-webkit-scrollbar-thumb:hover {
                        background: #555; 
                    }

                    .messages-content .replied-status {
                        color: #4CAF50;  
                        font-weight: bold;
                        margin-top: 5px;
                        font-size: 0.85rem;
                    }

                    .message-item {
                        padding: 10px 15px;
                        border-bottom: 1px solid #ccc;
                        transition: background-color 0.2s ease;
                    }

                    .message-item:hover {
                        background-color: #e6f0ff;  
                    }

                    .message-item p {
                        margin: 0;
                        font-weight: 500;
                        color: #333;
                        font-size: 13px;
                    }

                    .message-item span {
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

                    .message-panel.active {
                        right: 0;
                    }

                    .no-messages {
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
                    .new-message {
                        background-color: #f8d7da; 
                        padding: 10px 15px;
                    }

                    .messages-content {
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

                    @media (max-width: 768px) {
                        .message-wrapper {
                            z-index: 1000;
                        }

                        .message-panel,
                        .claim-stub-panel {
                            width: 100%; 
                            right: -100%;  
                        }

                        .message-panel.active,
                        .claim-stub-panel.active {
                            right: 0;  
                        }

                        .panel-header {
                            padding: 10px 12px; 
                            font-size: 1rem; 
                        }

                        .message-item {
                            padding: 8px 12px; 
                        }

                        .close-btn {
                            width: 25px;
                            height: 25px;
                            font-size: 14px; 
                        }
                    }

                    @media (max-width: 480px) {
                        .message-wrapper {
                            z-index: 9999;
                        }
                        
                        .message-panel,
                        .claim-stub-panel {
                            width: 100%; 
                            height: 100vh; 
                            right: -100%;
                        }

                        .panel-header h3 {
                            font-size: 0.9rem; 
                        }

                        .message-item p {
                            font-size: 0.85rem;  
                        }

                        .panel-footer a {
                            font-size: 0.9rem;  
                        }
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const messagePanel = document.getElementById('message-panel');
                        const messageBadge = document.getElementById('message-badge');
                        const removeModal = document.getElementById('removeMessageModal');

                        function toggleMessage() {
                            if (messagePanel.classList.contains('active')) {
                                messagePanel.classList.remove('active');
                            } else {
                                messagePanel.classList.add('active');
                            }
                        }

                        document.querySelector('.icon[onclick="toggleMessage()"]').addEventListener('click', function (event) {
                            event.stopPropagation();
                            toggleMessage();
                        });

                        document.querySelectorAll('.close-btns').forEach(btn => {
                            btn.addEventListener('click', function () {
                                messagePanel.classList.remove('active');
                            });
                        });

                        document.addEventListener('click', function (event) {
                            const removeModalVisible = removeModal && removeModal.style.display === 'block';
                            if (removeModalVisible && removeModal.contains(event.target)) {
                                return;
                            }
                            if (!messagePanel.contains(event.target) && !event.target.closest('.icon')) {
                                messagePanel.classList.remove('active');
                            }
                        });
                    });
                </script>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const messageContent = document.getElementById("message-content");
                    const messageBadge = document.getElementById("message-badge");
                    const messageIcon = document.querySelector(".icon[onclick='toggleMessage()']");
                    let openedMessages = new Set();

                    function fetchMessages() {
                        fetch('/messages')
                            .then(response => response.json())
                            .then(data => {
                                messageContent.innerHTML = '';  
                                let newMessages = 0;

                                if (data.length === 0) {
                                    messageContent.innerHTML = '<p class="no-messages">No new messages</p>';
                                } else {
                                    data.forEach(message => {
                                        const item = document.createElement('div');
                                        item.classList.add('message-item');

                                        if (message.status === "new" && !openedMessages.has(message.id)) {
                                            item.classList.add("new-message");
                                        }

                                        item.innerHTML = `
                                            <div class="messages-content">
                                                <div>
                                                    <p><strong>From:</strong> ${message.fname} ${message.lname}</p>
                                                    <span>${formatTime(message.created_at)}</span>
                                                    ${message.status === "replied" ? '<p class="replied-status">• REPLIED</p>' : ''}
                                                </div>
                                                <button onclick="openMessageModal(${message.id})" class="view-button">View</button>
                                            </div>
                                        `;

                                        messageContent.appendChild(item);
                                    });

                                    data.forEach(message => {
                                        if (message.status === "new") {
                                            openedMessages.add(message.id);
                                        }
                                    });

                                    newMessages = data.filter(m => m.status === "new").length;
                                }

                                messageBadge.style.display = newMessages > 0 ? "inline" : "none";
                                messageBadge.textContent = newMessages;

                                markMessagesAsRead();
                            })
                        .catch(error => console.error('Error fetching messages:', error));
                    }

                        function fetchMessageCount() {
                            fetch('/messages')
                                .then(response => response.json())
                                .then(data => {
                                    let newMessages = data.filter(message => message.status === "new").length;
                                    messageBadge.textContent = newMessages;
                                    messageBadge.style.display = newMessages > 0 ? "inline" : "none";
                                })
                                .catch(error => console.error("Error fetching message count:", error));
                        }

                        function markMessagesAsRead() {
                            fetch('/messages/mark-as-read', {
                                method: "POST",
                                headers: { 
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(() => {
                                messageBadge.style.display = "none";  
                            })
                            .catch(error => console.error("Error marking messages as read:", error));
                        }

                        messageIcon.addEventListener("click", function (event) {
                            event.stopPropagation();
                            fetchMessages();
                        });

                        document.addEventListener("click", function (event) {
                            if (!messageContent.contains(event.target) && event.target !== messageIcon) {
                                document.querySelectorAll('.new-message').forEach(item => {
                                    item.classList.remove('new-message');
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

                        fetchMessageCount();
                    });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const messageModal = document.getElementById('messageModal');
                    const messageIcon = document.querySelector('.icon[onclick="toggleMessageModal()"]');
                
                    function toggleMessageModal() {
                        messageModal.classList.toggle('active');
                    }
                
                    function closeMessageModal(event) {
                        if (!event || event.target === messageModal) {
                            messageModal.classList.remove('active');
                        }
                    }
                
                    if (messageIcon) {
                        messageIcon.addEventListener('click', function (event) {
                            event.stopPropagation();
                            toggleMessageModal();
                        });
                    }
                
                    document.addEventListener('click', function (event) {
                        if (!messageModal.contains(event.target) && !event.target.closest('.icon')) {
                            closeMessageModal();
                        }
                    });
                });
            </script>

        <div id="messageModal" class="new-modal-overlay">
            <div class="new-modal-container"> 
                <div class="new-modal-header">
                    <h2 class="new-modal-title">
                        <i class="fa fa-envelope-open" aria-hidden="true"></i> Message Details
                    </h2>
                    <button class="new-modal-close" onclick="closeMessageModal()">×</button>
                </div>
            
                <div class="new-modal-body">
                    <div class="new-modal-content">
                        <div class="new-modal-info">
                            <div class="new-info-row">
                                <strong class="new-label">From:</strong>
                                <span id="new-modal-name" class="new-value"></span>
                            </div>
                            <div class="new-info-row">
                                <strong class="new-label">Phone:</strong>
                                <span id="new-modal-phone" class="new-value"></span>
                            </div>
                            <div class="new-info-row">
                                <strong class="new-label">Email:</strong>
                                <span id="new-modal-email" class="new-value"></span>
                            </div>
                        </div>

                        <div class="new-message-box">
                            <strong class="new-message-title">Message:</strong>
                            <div id="new-modal-message" class="new-message-content"></div>
                        </div>

                        <div class="new-reply-box">
                            <strong class="new-message-title">Reply:</strong>
                            <textarea id="replyMessage" class="new-reply-textarea" placeholder="Type your reply here..."></textarea>
                            <div class="new-modal-footer">
                                <button class="new-modal-btn" onclick="sendReply()">Submit</button>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </div> 

        <style>
            .new-modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
            }
            
            .new-modal-container {
                width: 90%;
                max-width: 600px;
                background: #fff;
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
                transform: scale(0.9);
                transition: transform 0.3s ease-in-out;
            } 

            .new-modal-overlay.active {
                display: flex;
            }

            .new-modal-close {
                cursor: pointer;
            }

            .new-modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #eee;
                padding-bottom: 15px;
                margin-bottom: 20px;
            }

            .new-modal-title {
                font-size: 22px;
                color: #333;
                font-weight: bold;
                display: flex;
                align-items: center;
            }

            .new-modal-title i {
                font-size: 24px;
                margin-right: 10px;
                color: #3b87f3;
            }

            .new-modal-close {
                font-size: 32px;
                color: #aaa;
                border: none;
                background: none;
                cursor: pointer;
                transition: color 0.3s ease;
            }

            .new-modal-close:hover {
                color: #e74c3c;
            }
             
            .new-modal-body {
                font-size: 16px;
                line-height: 1.6;
                color: #555;
                padding-bottom: 20px;
                max-height: 400px;
                overflow-y: auto; 
                padding-right: 10px;
            }
 
            .new-modal-body::-webkit-scrollbar {
                width: 6px; 
            }

            .new-modal-body::-webkit-scrollbar-track {
                background: transparent; 
            }

            .new-modal-body::-webkit-scrollbar-thumb {
                background: #888; 
                border-radius: 10px; 
            }

            .new-modal-body::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }

            .new-message-content {
                font-size: 16px;
                line-height: 1.8;
                color: #000;
                background: #fff;
                padding: 15px;
                border-radius: 8px;
                box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.05);
                word-wrap: break-word;  
            }
            
            .new-modal-info {
                margin-bottom: 30px;
            }

            .new-info-row {
                margin-bottom: 12px;
            }

            .new-label {
                font-weight: 600;
                color: #333;
                margin-right: 10px;
            }

            .new-value {
                color: #000;
                font-style: italic;
            }
            
            .new-message-box {
                background: #f9f9f9;
                padding: 15px;
                border-radius: 8px;
                box-shadow: inset 0 2px 15px rgba(0, 0, 0, 0.05);
                margin-top: 15px;
            }

            .new-message-title {
                font-size: 18px;
                font-weight: 600;
                color: #333;
                margin-bottom: 12px;
            }

            .new-message-content {
                font-size: 16px;
                line-height: 1.8;
                color: #000;
                background: #fff;
                padding: 15px;
                border-radius: 8px;
                box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.05);
            }
            
            .new-modal-footer {
                display: flex;
                justify-content: flex-start;
                padding-top: 20px;
                padding: 10px;
            }
            
            .new-modal-btn {
                background-color: #3b87f3;
                color: #fff;
                border: none;
                padding: 12px 30px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 30px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease, transform 0.2s ease;
                z-index: 10000;
            }

            .new-modal-btn:hover {
                background-color: #2872e0;
                transform: scale(1.05);
            }
            
            .new-modal-overlay.show {
                display: flex;
                opacity: 1;
            }

            .new-modal-overlay.show .new-modal-container {
                transform: scale(1);
            }
            .new-reply-box {
                margin-top: 20px;
            }

            .new-reply-textarea {
                width: 100%;
                height: 120px;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 10px;
                font-size: 15px;
                resize: vertical;
                box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
            }
        </style>

        <div id="reply-loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:99999; align-items:center; justify-content:center;">
            <div style="background:#fff; padding:24px 40px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.2); font-size:1.2em; font-weight:500; display:flex; align-items:center; gap:16px;">
                <span class="spinner" style="width:28px; height:28px; border:4px solid #3b87f3; border-top:4px solid #e3e9f0; border-radius:50%; display:inline-block; animation:spin 0.8s linear infinite;"></span>
                Sending...
            </div>
        </div>
        <style>
            @keyframes spin {
                0% { transform: rotate(0deg);}
                100% { transform: rotate(360deg);}
            }
        </style> 


    <script>
        function showLoading() {
            document.getElementById('reply-loading-overlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('reply-loading-overlay').style.display = 'none';
        }

        function sendReply() {
            const email = document.getElementById("new-modal-email").textContent;
            const name = document.getElementById("new-modal-name").textContent;
            const message = document.querySelector(".new-reply-textarea").value.trim();  
            const messageId = document.getElementById("messageModal").getAttribute("data-id");

            if (!message) {
                showErrorAlert("Please enter a reply message.");
                return;
            }

            closeMessageModal();
            showLoading();

            fetch("/send-reply", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ email, name, message, id: messageId })
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                showSuccessAlert(data.success1);
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                showErrorAlert("Failed to send reply.");
            });
        }

        function showSuccessAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'success_alert';
            alertDiv.textContent = message;
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.add('hide');
                setTimeout(() => alertDiv.remove(), 500);  
            }, 3000);
        }

        function showErrorAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'error_alert';
            alertDiv.textContent = message;
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.add('hide');
                setTimeout(() => alertDiv.remove(), 500); 
            }, 3000);
        }
    </script>

     

        <script>
            function openMessageModal(messageId) {
                fetch(`/message/${messageId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success1) { 
                            document.getElementById("new-modal-name").textContent = `${data.message.fname} ${data.message.lname}`;
                            document.getElementById("new-modal-phone").textContent = data.message.phone;
                            document.getElementById("new-modal-email").textContent = data.message.email;
                            document.getElementById("new-modal-message").textContent = data.message.message;
                            document.getElementById("replyMessage").value = data.message.reply || "";  

                            let modal = document.getElementById("messageModal");
                            modal.setAttribute("data-id", messageId); 
                            modal.classList.add("show");
                            modal.style.display = "flex";  
                        } else {
                            alert("Message not found!");
                        }
                    })
                    .catch(error => console.error("Error fetching message:", error));
            }

            document.addEventListener("DOMContentLoaded", function () {
                const modalOverlay = document.getElementById("messageModal");
                const modalContent = document.querySelector(".new-modal-container");

                modalOverlay.addEventListener("click", function () {
                    closeMessageModal();
                });

                modalContent.addEventListener("click", function (event) {
                    event.stopPropagation();
                });
            });

            function closeMessageModal() {
                let modal = document.getElementById("messageModal");
                let messagePanel = document.getElementById("message-panel");  

                modal.classList.remove("show");
                messagePanel.classList.remove("active");  

                setTimeout(() => {
                    modal.style.display = "none";
                }, 400);
            }
 
            document.querySelector(".new-reply-textarea").addEventListener("click", function(event) {
                event.stopPropagation(); 
            });

        </script>


        <div class="modal-new" id="removeMessageModal">
            <div class="modal-content-new">
                <h2>Are you sure?</h2>
                <p>This will remove all messages permanently.</p>
                <div class="modal-buttons-new">
                    <button class="confirm-btn-new" onclick="confirmRemoveMessages()">Yes, Remove</button>
                    <button class="cancel-btn-new" onclick="closeRemoveModal()">Cancel</button>
                </div>
            </div>
        </div>
        <script>
            function openRemoveModal() {
                fetch('/messages') 
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            const alertBox = document.createElement("div");
                            alertBox.className = "error_alert";
                            alertBox.innerHTML = `No Messages Exist`;
                            document.body.appendChild(alertBox);

                            setTimeout(() => {
                                alertBox.classList.add("hide");
                                setTimeout(() => alertBox.remove(), 500);
                            }, 3000);

                            return;
                        }

                        let modal = document.getElementById("removeMessageModal");
                        if (modal) {
                            modal.style.display = "block";
                            setTimeout(() => modal.classList.add("show"), 10);
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching messages:", error);
                    });
            }

            function confirmRemoveMessages() {
                fetch('/messages/remove-all', {
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

                        let messagePanel = document.getElementById("message-panel");
                        if (messagePanel) {
                            messagePanel.classList.remove("active");
                        }

                        let messageModal = document.getElementById("messageModal");
                        if (messageModal && (messageModal.classList.contains("show") || messageModal.style.display === "flex" || messageModal.style.display === "block")) {
                            messageModal.classList.remove("show");
                            setTimeout(() => {
                                messageModal.style.display = "none";
                            }, 400);
                        }

                        let messageContent = document.getElementById("message-content");
                        let messageBadge = document.getElementById("messageBadge");

                        if (messageContent) {
                            messageContent.innerHTML = "<p>No new messages</p>";
                        }
                        if (messageBadge) {
                            messageBadge.style.display = "none";
                        }

                        showAlert(data.success, "success");   
                    } else if (data.error) {
                        showAlert(data.error, "error");  
                    } else {
                        console.error("Error: Unexpected response");
                    }
                })
                .catch(error => {
                    console.error("Error removing messages:", error);
                    showAlert("Failed to remove messages", "error");   
                });
            }
            
            function closeRemoveModal() {
                let modal = document.getElementById("removeMessageModal");
                if (modal) {
                    modal.classList.remove("show");
                    setTimeout(() => {
                        modal.style.display = "none";  
                        modal.setAttribute("aria-hidden", "true");  
                    }, 300);
                }
            }

            function showAlert(message, type) {
                let alertClass = type === "success" ? "success_alert" : "error_alert";

                let oldAlert = document.getElementById("custom-alert");
                if (oldAlert) oldAlert.remove();

                let alertDiv = document.createElement("div");
                alertDiv.id = "custom-alert";
                alertDiv.className = alertClass;
                alertDiv.innerHTML = `${message}`;  
                
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
                
                    <div class="dropdown">
                        <button class="dropdown-toggle" id="dropdown-btn" onclick="toggleDropdown()">
                            <i class="fas fa-user-circle"></i>
                        </button>
                    
                            <div class="dropdown-menu" id="dropdown-menu">
                                <div class="dropdown-header">
                                    <strong>
                                        @if(session()->has('teller_fname') && session()->has('teller_lname'))
                                            {{ session('teller_fname') }} {{ session('teller_lname') }}
                                        @else
                                            Guest
                                        @endif
                                    </strong>
                                    <br>
                                    <span class="email">
                                        @if(session()->has('teller_email'))
                                            {{ session('teller_email') }}
                                        @else
                                            guest@example.com
                                        @endif
                                    </span>
                                </div>
                                    <a href="{{ route('teller.pages.profile') }}"> <i class="fa fa-user"></i> Profile</a>
                                    <a href="{{ route('change_password') }}"> <i class="fa fa-key"></i> Change Password</a>
                                    <a href="#" onclick="openLogoutModalNew()"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                    </div>
                </div>
            </div>
                <div>
                    @yield('add')
                </div>
        
                <div class="content">
                    @yield('content')
                </div>
    </div>
</div>


<style>
    .dropdown {
         position: relative;
         display: inline-block;
     }
 
     .dropdown-toggle {
         background-color: transparent;
         border: none;
         cursor: pointer;
         display: flex;
         align-items: center;
         font-size: 14px;
         padding: 5px 10px;
     }
 
     .dropdown-toggle i {
         margin-left: 5px;
         font-size: 23px;
         transition: color 0.3s ease, transform 0.3s ease;
     }
 
     .dropdown-toggle i:hover {
         color: #000; 
         transform: translateY(-2px); 
     }
 
     .dropdown-menu {
        display: none;
         position: absolute;
         z-index: 9999;
         background-color: #fff;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         min-width: 200px;
         right: 0;
         border-radius: 5px;
         margin-top: 5px;
         padding: 10px 0;
     }
 
     .dropdown-menu a {
         display: flex;                  
         align-items: center;           
         padding: 8px 20px;
         text-decoration: none;
         font-size: 14px;
         color: #333;
         transition: background-color 0.3s;
         gap: 8px;               
     }
 
     .dropdown-menu a i {
         font-size: 16px;             
     }
 
     .dropdown-menu a:hover {
         background-color: #f5f5f5;
     }
 
     .dropdown-header {
         padding: 10px 20px;
         border-bottom: 1px solid #eee;
         margin-bottom: 5px;
         text-align: left;             
     }
 
     .email {
         font-size: 12px;
         color: #777;
     }
 
     @media (max-width: 576px) {
         .dropdown-toggle i {
             font-size: 18px;
         }
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
            <form id="logout-form-new" action="{{ route('teller.logout') }}" method="POST">
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
        const modal = document.getElementById("logout-modal-new");
        const modalContent = document.querySelector(".modal-content-new");

        modalContent.classList.add("close"); 

        setTimeout(() => {
            modal.classList.remove("show");
            modalContent.classList.remove("close");  
        }, 300);  
    }


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
       function toggleDropdown() {
            var dropdownMenu = document.getElementById("dropdown-menu");
            dropdownMenu.style.display = (dropdownMenu.style.display === "block") ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.closest('.dropdown') && !event.target.matches('.dropdown-toggle')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].style.display = "none";
                }
            }
        }
    </script>
             
 
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
            padding: 0 10px;
        }

        .search-input {
            font-size: 14px;
        }

        .search-icon {
            font-size: 16px;
        }

        .clear-btn {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .search-container {
            max-width: 50%;
            padding: 0 8px;
            left: 30px;
        }

        .search-input {
            font-size: 12px;
        }

        .search-icon {
            font-size: 14px;
        }

        .clear-btn {
            font-size: 12px;
        }
    }

    @media (max-width: 1024px) {
        .topbar {
            width: 100%;
            margin-left: 0;
            padding: 10px;
            left: 0;
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
