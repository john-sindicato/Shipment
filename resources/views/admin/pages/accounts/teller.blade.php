@extends('admin.layout.layout')
@if(!session('admin_email'))
    <script>
        window.location.href = "{{ route('admin.login') }}";
    </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

</style>
    @if(session('success'))
    <div id="success-alert" class="success_alert">
        <strong></strong> {{ session('success') }}
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
        .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
    .alert-box {
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
        opacity: 0;
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

    .alert-box.hide {
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
    
@if(session('error_phone'))
    <div id="error-alert-phone" class="alert-box">
        <strong>Error!</strong> {{ session('error_phone') }}
    </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let alertBox = document.querySelector(".alert-box");

                if (alertBox) {
                    setTimeout(() => {
                        alertBox.classList.add("hide");  
                    }, 3000);  
                }
            });
        </script>
@endif
    
@if(session('error_email'))
        <div id="error-alert-email" class="alert-box">
            <strong>Error!</strong> {{ session('error_email') }}
        </div>
    <script>
        setTimeout(function() {
            var alert = document.getElementById('error-alert-email');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500);
            }
        }, 3000);
    </script>
@endif
    

    
<script>
    function search() {
        const input = document.getElementById("search1");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("table");
        const tr = table.getElementsByTagName("tr");
        const clearBtn = document.querySelector(".clear-btn");

        clearBtn.style.display = filter ? "block" : "none";

        for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName("td");
            let found = false;

            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    const txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().includes(filter)) {
                        found = true;
                        break; 
                    }
                }
            }
            tr[i].style.display = found ? "" : "none"; 
        }
    }

    function clearSearch() {
        const input = document.getElementById("search1");
        input.value = "";
        search();  
    }
</script>

    <div id="profile-alert" class="alert-box" style="display: none;">
        <strong></strong> Please upload a profile picture.
    </div>

    <div id="phone-alert" class="alert-box" style="display: none;">
        <strong></strong> Please enter a valid Philippine phone number.
    </div>

<script>
    function validateForm() {
        const profilePic = document.getElementById("profilePicInput").files.length;
        const phoneInput = document.getElementById("phone").value.trim();
        let profileAlert = document.getElementById("profile-alert");
        let phoneAlert = document.getElementById("phone-alert");

        const philippinePhoneRegex = /^09\d{9}$/;  

        let isValid = true;

        if (profilePic === 0) {
            showAlert(profileAlert);
            isValid = false;
        }

        if (!philippinePhoneRegex.test(phoneInput)) {
            showAlert(phoneAlert);
            isValid = false;
        }

        return isValid;  
    }

    function showAlert(alertBox) {
        alertBox.classList.remove("hide");
        alertBox.style.display = "block"; 
        alertBox.style.opacity = "1";

        setTimeout(() => {
            alertBox.classList.add("hide");
        }, 3000);
    }
</script>

<style>
    .alert-box {
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
        opacity: 0;
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

    .alert-box.hide {
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

    <div id="tellerModal" class="modals">
        <div class="modal-contents">
            <form action="{{ route('teller.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf            
                    <div class="profile-pictures">
                        <div class="profile-box">
                            <img src="default-avatar.jpg" alt="Profile" id="profileDisplay" class="profile">
                        </div>
                        
                        <div class="file-input-container">
                            <input type="file" name="profile" id="profilePicInput" class="file-input" accept="image/*" onchange="previewProfilePicture(event)">
                            <label for="profilePicInput" class="file-label">Choose File</label>
                        </div>
                    </div>
                    
                    <div class="profile-content">
                        <div class="personal-info">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="fname" placeholder="Enter First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name="lname" placeholder="Enter Last Name" required>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pnumber">Phone Number</label>
                                <input type="number" id="phone" name="phone" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="Enter Email Address" required>
                            </div>
                        </div>
        
                        <div class="address-info">
                            <div class="form-group">
                                <label for="street">Street Address</label>
                                <input type="text" id="street" name="street" placeholder="Enter Street Address" required>
                            </div>
                            <div class="form-group">
                                <label for="brgy">Subdivision / Barangay</label>
                                <input type="text" id="brgy" name="brgy" placeholder="Enter Subdivision / Barangay" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="Enter City" required>
                            </div>
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" placeholder="Enter Province" required>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Postal / Zipcode</label>
                                <input type="number" id="zipcode" name="zipcode" placeholder="Enter Postal / Zipcode" required>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <input type="text" id="branch" name="branch" placeholder="Enter Branch" required>
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="submit-btn">Register</button>
                        <a href="#" class="cancel-btnt" onclick="closeModal()">Cancel</a>
                    </div>
                </form>
        </div>
    </div>
<style>
        input::placeholder {
            color: #000; 
        }

        .modals {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-contents {
            background-color: white;
            margin: 5px auto;
            padding: 30px;
            width: 80%;
            height: 98%;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-size: 14px;
        }

        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes modalFadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.8);
            }
        }

        .modals.actions {
            display: flex;
        }

        .modals.show .modal-contents {
            animation: modalFadeIn 0.5s forwards;
        }

        .modals.hide .modal-contents {
            animation: modalFadeOut 0.5s forwards;
        }


        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close:hover {
            color: red;
            transform: scale(1.2);
        }

        .profile-pictures {
            text-align: center;
        }

        .profile-box {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px auto;
            border: 2px solid #ccc;
        }

        .profile {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

       .form-group input, select {
            width: 55%; 
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #000;
        }

       .form-group input, select:focus {
            outline: none;
            border-color: #007BFF; 
        }

        .file-input-container {
            text-align: center;
            margin-top: 10px;
        }

        .file-input {
            display: none;
        }

        .file-label {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            font-size: 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .file-label:hover {
            background-color: #0056b3;
        }

        .profile-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .personal-info, .address-info {
            width: 48%;
        }

        .form-group {
            margin-bottom: 8px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #555;
            font-size: 12px;
            margin-bottom: 1px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-group {
            text-align: center;
            margin-top: 12px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .submit-btn, .cancel-btnt {
            display: inline-block;
            text-align: center;
            padding: 8px 40px;
            margin: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease-in-out;
        }

        .submit-btn {
            background: linear-gradient(to bottom, #4285F4, #3367d6);
            color: white;
        }

        .submit-btn:hover {
            background: linear-gradient(to bottom, #5294FF, #4285F4);
            box-shadow: 0 4px 8px rgba(66, 133, 244, 0.3);
            transform: translateY(-1px);
        }

        .cancel-btnt {
            background-color: #dc3545;
            color: white;
        }

        .cancel-btnt:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            .modals{
                overflow: auto;
            }
            .modal-contents {
                width: 90%;
                height: 90%;
                margin-top: 80px;
                overflow: auto;
            }

            .profile-content {
                flex-direction: column;
            }

            .personal-info, .address-info {
                width: 100%;
            }
        }
</style>

<script>
    window.addEventListener("click", function (event) {
        let tellerModal = document.getElementById('tellerModal');
        let editModal = document.getElementById('editModal');
        let viewModal = document.getElementById('viewModal');  

        if (event.target === tellerModal) {
            closeModal(); 
        } else if (event.target === editModal) {
            closeModal2(); 
        } else if (event.target === viewModal) {  
            closeviewModal();
        }
    });

    function openModal() {
        const modal = document.getElementById("tellerModal");
        modal.style.display = "flex";
        setTimeout(() => modal.classList.add("show"), 10);
    }

    function closeModal() {
        const modal = document.getElementById("tellerModal");
        modal.classList.remove("show");
        modal.classList.add("hide");

        setTimeout(() => {
            modal.style.display = "none";
            modal.classList.remove("hide");
        }, 500); 
    }

    function closeModal2() {
        const modal = document.getElementById("editModal");
        modal.classList.remove("show");
        modal.classList.add("hide");

        setTimeout(() => {
            modal.style.display = "none";
            modal.classList.remove("hide");
        }, 500);
    }

    function closeviewModal() {
        const modal = document.getElementById("viewModal");
        modal.classList.remove("show");
        modal.classList.add("hide");

        setTimeout(() => {
            modal.style.display = "none";
            modal.classList.remove("hide");
        }, 500); 
    }

    document.querySelector(".cancel-button").addEventListener("click", closeModal);
    document.querySelector(".cancel-btnt").addEventListener("click", closeModal2);
</script>

<script>
    function previewProfilePicture(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('profileDisplay').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


<style> 
    .add-container {
        display: flex;
        justify-content: flex-start;
        margin: 6% auto;
        margin-bottom: 10px;
        gap: 10px;
    }

    .add-btn {
        background-color: #fff;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .add-btn i {
        font-size: 16px;
        color: #555;
    }

    .add-btn:hover {
        background-color: #f5f5f5;
        border-color: #bbb;
    }

    .add-btn:active {
        background-color: #eaeaea;
        border-color: #999;
    }

    .container1 {
        background-color: #fff;   
        border: 2px solid #ddd;
        border-radius: 8px;  
        /*box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);*/  
        width: 100%;  
        height: 100%;
        overflow: hidden;  
    }

    .table-container {
        margin-top: 0px;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        height: 100vh; 
        max-height: 480px;  
    }

    .table-wrapper {
        overflow-y: auto;
        max-height: 447px;
    }

    .table-wrapper::-webkit-scrollbar {
        width: 8px; 
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: transparent;   
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: #d3d3d3;  
        border-radius: 10px;  
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #a9a9a9;  
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        border-spacing: 0;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #3c4043;
        table-layout: auto;
        min-width: 600px;
    }

    .custom-table thead {
        position: sticky;
        top: 0;
        z-index: 0;
        background-color: #fff;
        box-shadow: 0 1px 0 #e0e0e0;
    }

    .custom-table th {
        padding: 10px 15px;
        border-bottom: none;
        font-weight: 500;
        background-color: transparent;
        text-transform: uppercase;
        font-size: 12px;
        color: #000;
    }

    .custom-table td {
        padding: 10px 15px;
        color: #000;
        word-wrap: break-word;
        align-items: center;
    }

    .custom-table tbody tr {
        border: none;
        border-bottom: 1px solid #e0e0e0;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f3f4;
        cursor: pointer;
    }

    .custom-table tbody tr {
        border: none;
        border-bottom: 1px solid #e0e0e0;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f3f4;
        cursor: pointer;
    }

    .custom-table td:not(:last-child) {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }

    .actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px; 
    }

    .actions a,
    .actions button {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s, visibility 0.3s;
    }

    .custom-table tbody tr:hover .actions a,
    .custom-table tbody tr:hover .actions button {
        visibility: visible;
        opacity: 1;
    }

        
    .tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 60px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;  
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #333 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }

    .view-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 4px;
        transition: background 0.3s, transform 0.2s;
        border: none;
        cursor: pointer;
    }

    .view-btn {
        color: #fff; 
        background-color: #00243d;
        border: 1px solid #e0e0e0;  
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);  
    }

    .view-btn:hover {
        background-color: #003a5c;
        transform: scale(1.03);
    }
 
    .edit-btn,
    .delete-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 4px;
        transition: background 0.3s, transform 0.2s;
        border: none;
        cursor: pointer;
    }
 
    .edit-btn {
        color: #000;
        transition: background-color 0.3s, transform 0.2s;
    }

    .edit-btn:hover {
        transform: scale(1.03);
    }

    .delete-btn {
        color: #000;
        background-color: transparent;
    }

    .delete-btn:hover {
        transform: scale(1.03);
    }

    .edit-btn i,
    .delete-btn i {
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .actions a,
        .actions button {
            visibility: visible !important;
            opacity: 1 !important;
        }
    }
    @media (max-width: 1024px) { 
            .add-container {
                margin: 30% auto;
                margin-bottom: 8px;
            }
        }
        @media (max-width: 768px) { 
            .add-container{
                margin: 30% auto;
                margin-bottom: 8px;
            }
        }
        @media (max-width: 480px) { 
            .add-container{
                margin: 40% auto;
                margin-bottom: 8px;
            }
        }
</style>    

@section('content')
    <div class="add-container">
        <button class="add-btn" onclick="openModal()">
            <i class="fas fa-plus"></i> Add New
        </button>
    </div>
    <div class="container1">
        <div class="table-container">
            <div class="table-wrapper">
                <table class="custom-table" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Branch</th>
                            <th>View Details</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tellers as $index => $teller)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $teller->fname }} {{ $teller->lname }}</td>
                            <td>{{ $teller->phone }}</td>
                            <td>{{ $teller->email }}</td>
                            <td>{{ $teller->branch }}</td>
                            <td>
                                <button class="view-btn" onclick="openviewModal({{ $teller->id }})"
                                    data-id="{{ $teller->id }}"
                                    data-fname="{{ $teller->fname }}"
                                    data-lname="{{ $teller->lname }}"
                                    data-dob="{{ $teller->dob }}"
                                    data-gender="{{ $teller->gender }}"
                                    data-phone="{{ $teller->phone }}"
                                    data-email="{{ $teller->email }}"
                                    data-address="{{ $teller->street }}, {{ $teller->brgy }}, {{ $teller->city }}, {{ $teller->province }}, {{ $teller->zipcode }}"
                                    data-branch="{{ $teller->branch }}"
                                    data-profile="{{ $teller->profile }}">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                            <td class="actions">
                                <a href="#" class="edit-btn tooltip"
                                    data-id="{{ $teller->id }}"
                                    data-fname="{{ $teller->fname }}"
                                    data-lname="{{ $teller->lname }}"
                                    data-dob="{{ $teller->dob }}"
                                    data-gender="{{ $teller->gender }}"
                                    data-phone="{{ $teller->phone }}"
                                    data-email="{{ $teller->email }}"
                                    data-street="{{ $teller->street }}"
                                    data-brgy="{{ $teller->brgy }}"
                                    data-city="{{ $teller->city }}"
                                    data-province="{{ $teller->province }}"
                                    data-zipcode="{{ $teller->zipcode }}"
                                    data-branch="{{ $teller->branch }}"
                                    data-profile="{{$teller->profile }}">
                                    <i class="fas fa-edit"></i>  
                                    <span class="tooltiptext">Edit</span>
                                </a>
                            
                                <button type="submit" class="delete-btn tooltip" onclick="openDeletePopup({{ $teller->id }})">
                                    <i class="fas fa-trash-alt"></i>  
                                    <span class="tooltiptext">Delete</span>
                                </button>
                            </td>                
                        </tr>
                        @empty
                            <tr>
                                <td colspan='7' style='text-align:center;'>No Teller found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page">
            @if($tellers->isNotEmpty())
                <div class="pagination-container">
                    <div class="pagination-links">
                        {{ $tellers->onEachSide(1)->links('vendor.pagination.custom') }}
                    </div>
                
                    <div class="results-summary">
                        Showing {{ $tellers->count() }} out of {{ $tellers->total() }} Teller(s)
                    </div>            
                </div>
            @endif
        </div>  
    </div>
@endsection

<style>
    .page { 
        display: flex;
        justify-content: center; 
        height: 100vh;
        max-height: 90px; 
    }

    .pagination-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 5px;
        background-color: transparent; 
        border-radius: 10px; 
    }

    .pagination-links {
        display: flex;
        gap: 5px;
        margin-bottom: 5px;  
    }

    .results-summary {
        font-size: 14px;
        color: #004080;
        text-align: center;
        margin-bottom: 10px;  
    }

    .pagination {
        display: flex;
        justify-content: center;
        padding: 15px 0;
        list-style: none;
        gap: 5px;
    }

    .pagination a,
    .pagination .active span {
        background: linear-gradient(135deg, #007BFF, #00BFFF);
        color: #fff;
        padding: 8px 15px;
        border-radius: 3px;
        text-decoration: none;
        transition: background 0.3s, transform 0.2s;
    }

    .pagination a:hover {
        background: linear-gradient(135deg, #0056b3, #0099cc);
        transform: scale(1.1);
    }

    .pagination .disabled span {
        background-color: #ddd;
        color: #aaa;
        padding: 8px 15px;
        border-radius: 3px;
    }

    .pagination .active span {
        background: #004080; 
    }

    .pagination .dots span {
        background-color: transparent;
        color: #007BFF;
    }

    .empty-state {
        text-align: center;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .empty-image {
        width: 150px;  
        height: auto;
    }

    .empty-note {
        font-size: 16px;
        color: #555;
        margin-top: 10px;
    }
    
    @media screen and (max-width: 600px) {
        .empty-image {
            width: 120px;
        }
        
        .empty-note {
            font-size: 14px;
        }
    }
</style>



<div id="viewModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close" onclick="closeviewModal()">&times;</span>
        <img src="#" alt="Profile" id="profileDisplayss" class="profile-pic">
        <div class="user-info">
            <div class="info-row">
                <span class="info-label">First Name:</span>
                <span id="view-fname" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Last Name:</span>
                <span id="view-lname" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Gender:</span>
                <span id="view-gender" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date of Birth:</span>
                <span id="view-dob" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span id="view-phone" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span id="view-email" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Address:</span>
                <span id="view-address" class="info-value"></span>
            </div>
            <div class="info-row">
                <span class="info-label">Branch:</span>
                <span id="view-branch" class="info-value"></span>
            </div>
        </div>
    </div>
</div>

<script>
    function openviewModal(tellerId) {
        const viewBtn = document.querySelector(`[data-id='${tellerId}']`);

        document.getElementById("view-fname").textContent = viewBtn.getAttribute("data-fname");
        document.getElementById("view-lname").textContent = viewBtn.getAttribute("data-lname");
        document.getElementById("view-gender").textContent = viewBtn.getAttribute("data-gender");
        const rawDOB = viewBtn.getAttribute("data-dob");
            if (rawDOB) {
                const dob = new Date(rawDOB);
                const formattedDOB = dob.toLocaleDateString("en-US", {
                    year: "numeric",
                    month: "long",
                    day: "2-digit",
                });
                document.getElementById("view-dob").textContent = formattedDOB;
            } else {
                document.getElementById("view-dob").textContent = "N/A";
            }
        document.getElementById("view-phone").textContent = viewBtn.getAttribute("data-phone");
        document.getElementById("view-email").textContent = viewBtn.getAttribute("data-email");
        document.getElementById("view-address").textContent = viewBtn.getAttribute("data-address");
        document.getElementById("view-branch").textContent = viewBtn.getAttribute("data-branch");

        const profilePath = viewBtn.getAttribute("data-profile");
        const profilePicElement = document.getElementById("profileDisplayss");
        
        if (profilePath && profilePath !== "null") {
            profilePicElement.src = `/${profilePath}`;
        } else {
            profilePicElement.src = "default-profile.png";   
        }
                
        document.getElementById("viewModal").style.display = "block";
    }
</script>

<style>
    .custom-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s;
    }

    .custom-modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border-radius: 10px;
        width: 70%;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        animation: slideIn 0.3s;
        position: relative;  
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }

    .custom-modal.actions {
        display: flex;
    }

    .custom-modal.show .custom-modal-content {
        animation: modalFadeIn 0.5s forwards;
    }

    .custom-modal.hide .custom-modal-content {
        animation: modalFadeOut 0.5s forwards;
    }


    .close {
        color: #333;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        top: 15px;   
        right: 25px;   
        transition: color 0.2s;
    }

    .close:hover {
        color: #f44336;
    }
    
    .profile-pic {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
        border: 3px solid #32CD32;  
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        margin-right: 20px;
    }

    .user-info {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        left: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        flex-grow: 1;
    }

    .info-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .info-label {
        font-weight: bold;
        color: #343434;
        width: 150px;
        text-align: right;
        margin-right: 3px;
    }

    .info-value {
        margin-left: 5px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateY(-20px); }
        to { transform: translateY(0); }
    }

    @media screen and (max-width: 768px) {
        .custom-modal-content {
            width: 95%;
            margin-top: 100px;
            padding: 15px;
            flex-direction: column;  
        }

        .profile-pic {
            width: 200px;
            height: 200px;
            margin-right: 0;
            margin-bottom: 15px;
        }

        .info-label {
            width: 100px;
            text-align: right;  
        }
    }

    @media screen and (max-width: 480px) {
        .profile-pic {
            width: 150px;
            height: 150px;
        }

        .info-label {
            width: 90px;
        }

        .user-info {
            padding: 10px;
            font-size: 10px;
            word-wrap: break-word;
        }
    }
</style>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("editModal");
        const editBtns = document.querySelectorAll(".edit-btn");
        const form = document.getElementById("editForm");

        editBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                document.getElementById("edit-fname").value = this.getAttribute("data-fname");
                document.getElementById("edit-lname").value = this.getAttribute("data-lname");
                document.getElementById("edit-dob").value = this.getAttribute("data-dob");
                document.getElementById("edit-gender").value = this.getAttribute("data-gender");
                document.getElementById("edit-phone").value = this.getAttribute("data-phone");
                document.getElementById("edit-email").value = this.getAttribute("data-email");
                document.getElementById("edit-street").value = this.getAttribute("data-street");
                document.getElementById("edit-brgy").value = this.getAttribute("data-brgy");
                document.getElementById("edit-city").value = this.getAttribute("data-city");
                document.getElementById("edit-province").value = this.getAttribute("data-province");
                document.getElementById("edit-zipcode").value = this.getAttribute("data-zipcode");
                document.getElementById("edit-branch").value = this.getAttribute("data-branch");
                
                const profilePath = this.getAttribute("data-profile");
                if (profilePath) {
                    document.getElementById("profileDisplays").src = `/${profilePath}`;
                } else {
                    document.getElementById("profileDisplays").src = "#";
                }

                form.action = `/teller/update/${id}`;

                modal.style.display = "flex";
                setTimeout(() => modal.classList.add("show"), 10);
            });
        });
    });
</script>

<script>
function previewProfilePictures(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("profileDisplays").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
<div id="editModal" class="modal2">
    <div class="modal-content2">
        <form id="editForm" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')             
                <div class="profile-pictures">
                    <div class="profile-box">
                        <img src="#" alt="Profile" id="profileDisplays" class="profile">
                    </div>
                    
                    <div class="file-input-container">
                        <input type="file" name="profile" id="edit-profile" class="file-input" accept="image/*" onchange="previewProfilePictures(event)">
                        <label for="edit-profile" class="file-label">Choose File</label>
                    </div>
                </div>
                
                <div class="profile-content">
                    <div class="personal-info">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" id="edit-fname" name="fname" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="edit-lname" name="lname" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="edit-dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="edit-gender" name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pnumber">Phone Number:</label>
                            <input type="number" id="edit-phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" id="edit-email" name="email" required>
                        </div>
                    </div>
    
                    <div class="address-info">
                        <div class="form-group">
                            <label for="street">Street Address:</label>
                            <input type="text" id="edit-street" name="street" required>
                        </div>
                        <div class="form-group">
                            <label for="brgy">Subdivision / Barangay:</label>
                            <input type="text" id="edit-brgy" name="brgy" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" id="edit-city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Province:</label>
                            <input type="text" id="edit-province" name="province" required>
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Postal / Zip Code:</label>
                            <input type="number" id="edit-zipcode" name="zipcode" required>
                        </div>
                        <div class="form-group">
                            <label for="branch">Branch:</label>
                            <input type="text" id="edit-branch" name="branch" required>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" class="submit-btn">Update</button>
                    <a href="#" class="cancel-btnt" onclick="closeModal2()">Cancel</a>
                </div>
            </form>
    </div>
</div>

<style>
       .modal2 {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content2 {
            background-color: white;
            margin: 5px auto;
            padding: 30px;
            width: 80%;
            height: 98%;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-size: 14px;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes modalFadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.8);
            }
        }

        .modal2.actions {
            display: flex;
        }

        .modal2.show .modal-content2 {
            animation: modalFadeIn 0.5s forwards;
        }

        .modal2.hide .modal-content2 {
            animation: modalFadeOut 0.5s forwards;
        }

        @media (max-width: 600px) { 
            .modal2{
                overflow: auto;
            }
            .modal-content2 {
                width: 90%;
                height: 90%;
                margin-top: 80px;
                overflow: auto;
            }

            .profile-content {
                flex-direction: column;
            }

            .personal-info, .address-info {
                width: 100%;
            }
        }
</style>

<div id="deletePopup" class="popup-modal">
    <div class="popup-content">
        <h3>Are you sure you want to delete this teller?</h3>
        <p>This action cannot be undone.</p>
        <form id="deletePopupForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="popup-buttons">
                <button type="submit" class="popup-confirm-btn">Confirm</button>
                <button type="button" class="popup-cancel-btn" onclick="closeDeletePopup()">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openDeletePopup(tellerId) {
        document.getElementById("deletePopupForm").action = "/tellers/" + tellerId;
        document.getElementById("deletePopup").classList.add("show");
    }
    
    function closeDeletePopup() {
        document.getElementById("deletePopup").classList.remove("show");
    }

    document.getElementById("deletePopup").addEventListener("click", closeDeletePopup);

    document.addEventListener("keydown", function (event) {
        const popup = document.getElementById("deletePopup");
    
        if (popup.classList.contains("show")) {
            if (event.key === "Enter") {
                document.getElementById("deletePopupForm").submit();
            } else if (event.key === "Escape") {
                closeDeletePopup();
            }
        }
    });
</script>
    
    <style>
        .popup-modal {
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
    
        .popup-modal.show {
            display: block;
            opacity: 1; 
        }
        
        @keyframes popupSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    
        .popup-content {
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
            opacity: 0;
            transform: translateY(20px);
            animation: popupSlideIn 0.4s ease-out forwards;
        }
    
        .popup-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
    
        .popup-confirm-btn, .popup-cancel-btn {
            padding: 10px 25px;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
    
        .popup-confirm-btn {
            background: linear-gradient(135deg, #2196F3, #1565C0); 
            color: #fff;
            box-shadow: 0 4px 10px rgba(33, 150, 243, 0.5);
            padding: 10px 30px;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }
    
        .popup-confirm-btn:hover {
            background: #1565C0;
            box-shadow: 0 6px 15px rgba(33, 150, 243, 0.8);
            transform: translateY(-2px);
        }
    
        .popup-cancel-btn {
            background: linear-gradient(135deg, #F44336, #C62828);
            color: #fff;
            box-shadow: 0 4px 10px rgba(244, 67, 54, 0.5);
        }
    
        .popup-cancel-btn:hover {
            background: #C62828;
            box-shadow: 0 6px 15px rgba(244, 67, 54, 0.8);
            transform: translateY(-2px);
        }
    </style>
    
</body>
</html>