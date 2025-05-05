@extends('admin.layout.layout')
@section('title', 'rates')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <style>
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    
        .success_alert, .error_alert {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: dropDown 0.5s ease-out forwards;
        }
    
        .success_alert {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    
        .error_alert {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
    
        .success_alert.hide, .error_alert.hide {
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
    @endif
    
    @if(session('error'))
        <div id="error-alert" class="error_alert">
            <strong></strong> {{ session('error') }}
        </div>
    @endif
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let alertBoxes = document.querySelectorAll(".success_alert, .error_alert");
    
            alertBoxes.forEach(alertBox => {
                setTimeout(() => {
                    alertBox.classList.add("hide");
                }, 3000);
            });
        });
    </script>
<!--
<div class="topbar">
    <div class="search-container">
        <i class="fa fa-search search-icon"></i>
        <input type="text" class="search-input" id="search1" oninput="rate()" placeholder="Search..." />
        <span class="clear-btn" onclick="clearSearch()">✖</span>
    </div>
    <div class="add">
        <a href="javascript:void(0);" onclick="openModal1()">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
</div>
-->

<style>
     .clear-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #0077bb;
        font-weight: bolder;
        font-size: 14px;
        display: none;
    }
    
    .clear-btn:hover {
        color: #005b8f;
    }
</style>
   

<script>
    function openModal1() {
    const modal = document.getElementById("addPortModal");
    modal.style.display = "flex";
    setTimeout(() => modal.classList.add("show"), 10);
}

function closeModal1() {
    const modal = document.getElementById("addPortModal");
    modal.classList.remove("show");
    modal.classList.add("hide");

    setTimeout(() => {
        modal.style.display = "none";
        modal.classList.remove("hide");
    }, 500);  
}
</script>
 
<style>
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

    .modal1.show {
        display: flex;
    }

    .modal1.show .modal-content1 {
        animation: modalFadeIn 0.5s forwards;
    }

    .modal1.hide .modal-content1 {
        animation: modalFadeOut 0.5s forwards;
    }
    .modal1 {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }
    
    .modal-content1 {
        background: #fff;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
        display: flex;
        flex-direction: column;
        max-height: 90vh;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        opacity: 0;
        transform: scale(0.8);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }
    
    .modal-header1 {
        position: sticky;
        top: 0;
        z-index: 1;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
        background-color: transparent;
    }
    .modal-header1 .inner {
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title1 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }
    
    .modal-body1 {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        margin-bottom: 5px;
        font-weight: 600;
    }
    .form-group input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
    }
    .form-group input:focus {
        border-color: #007bff;
    }
    
    .modal-footer1 {
        position: sticky;
        bottom: 0;
        z-index: 1;
        border-top: 1px solid #eee;
        padding: 15px 0;
        background-color: transparent;
    }
    .modal-footer1 .inner {
        padding: 0 20px;
        display: flex;
        justify-content: flex-end;
    }
    
    .btn-blue {
        background-color: #007bff;
        color: white;
        padding: 10px 36px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-blue:hover {
        background-color: #0056b3;
    }

    .close-btn {
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: color 0.3s ease, background 0.2s ease;
    }
    .close-btn:hover {
        color: #000;
        background-color: rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 480px) {
        .modal-body1 {
            padding: 15px;
        }

        .modal-footer1 .inner {
            flex-direction: column;
            align-items: stretch;
        }

        .modal-footer1 .inner button {
            width: 100%;
        }
    }
</style>
<div id="addPortModal" class="modal1">
    <div class="modal-content1"> 
        <div class="modal-header1">
            <div class="inner">
                <h2 class="modal-title1">Add New Shipping Rate</h2>
                <button class="close-btn" onclick="closeModal1()" aria-label="Close">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>                
            </div>
        </div>        
 
        <form action="{{ route('port.store') }}" method="post" class="modal-body1">
            @csrf
            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" id="origin" name="origin" required placeholder="Enter origin">
            </div>
            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" required placeholder="Enter destination">
            </div>
            <div class="form-group">
                <label for="price">Price (per kilo)</label>
                <input type="number" id="price" name="price" required placeholder="Enter price">
            </div>
            <div class="form-group">
                <label for="delivery_days">Delivery Days</label>
                <input type="number" id="delivery_days" name="delivery_days" required placeholder="Enter delivery days">
            </div>
 
            <div class="modal-footer1">
                <button type="submit" class="btn-blue">Add</button> 
            </div>
        </form>
    </div>
</div>


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


<script>
    function filterStatus(status) {
        const rows = document.querySelectorAll("#table tbody tr");
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'all') {
                row.style.display = '';
            } else if (status === 'available' && rowStatus === 'open') {
                row.style.display = '';
            } else if (status === 'unavailable' && rowStatus === 'close') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

<style>   
    .filter-dropdown {
        padding: 10px 40px 10px 15px; 
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        color: #333;
        cursor: pointer;
        appearance: none;         
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23333' d='M70 100L30 40h80z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
    }

    .add-container {
        display: flex; 
        justify-content: flex-start;
        align-items: center;
        margin: 6% auto 10px;
        gap: 10px;
        flex-wrap: wrap;
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
        border-bottom: none;
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

    .view-btn {
        color: #000;
    }

    .view-btn:hover {
        transform: scale(1.03);
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
        <button class="add-btn" onclick="openModal1()">
            <i class="fas fa-plus"></i> Add New
        </button>
        
        <select id="statusFilter" class="filter-dropdown" onchange="filterStatus(this.value)">
            <option value="all">All</option>
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select>
    </div>

    <div class="container1">
        <div class="table-container">
            <div class="table-wrapper">
                <table class="custom-table" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Price (per kilo)</th>
                            <th>Delivery Days</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shippingRates as $index => $rate)
                            <tr data-status="{{ $rate->status }}">
                                <td>{{ $index + 1 }}</td>  
                                <td>{{ $rate->origin }}</td>
                                <td>{{ $rate->destination }}</td>
                                <td>₱ {{ number_format($rate->price, 2) }}</td>
                                <td>{{ $rate->delivery_days }} days</td>
                                <td> 
                                    <div class="action-buttons">    
                                        @if ($rate->status == 'open')
                                            <a href="#" class="status-button-open-button" onclick="toggleBranchStatus('{{ $rate->id }}', 'close')">
                                                <i class="fas fa-check-circle"></i><span>Available</span>
                                            </a>
                                        @else
                                            <a href="#" class="status-button-close-button" onclick="toggleBranchStatus('{{ $rate->id }}', 'open')">
                                                <i class="fas fa-times-circle"></i><span>Unavailable</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="actions">
                                    <a href="#" class="edit-btn tooltip"
                                        data-id="{{ $rate->id }}"
                                        data-origin="{{ $rate->origin }}"
                                        data-destination="{{ $rate->destination }}"
                                        data-price="{{ $rate->price }}"
                                        data-delivery_days="{{ $rate->delivery_days }}">
                                        <i class="fas fa-edit"></i> 
                                        <span class="tooltiptext">Edit</span>
                                    </a>
                                    <button class="delete-btn tooltip" onclick="openModal({{ $rate->id }})">
                                        <i class="fas fa-trash-alt"></i> 
                                        <span class="tooltiptext">Delete</span>
                                    </button>
                                </td>                      
                            </tr>
                            @empty
                                <tr>
                                    <td colspan='7' style='text-align:center;'>No Shipping Rate found.</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page">
            @if($shippingRates->isNotEmpty())
                <div class="pagination-container">
                    <div class="pagination-links">
                        {{ $shippingRates->onEachSide(1)->links('vendor.pagination.custom') }}
                    </div>
                
                    <div class="results-summary">
                        Showing {{ $shippingRates->count() }} out of {{ $shippingRates->total() }} Shipping Rate(s)
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


<style>
    .action-buttons {
        display: flex;
        justify-content: left;
        align-items: left;
        gap: 8px;
    }

    .status-button-open-button,
    .status-button-close-button {
        display: flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
        font-size: 10px;  
        font-weight: 600;  
        padding: 6px 12px;  
        border-radius: 4px;  
        transition: background 0.3s, transform 0.2s;
    }

    .status-button-open-button {
        background-color: #28a745;  
        color: white;
        border: 1px solid #218838;
    }

    .status-button-open-button:hover {
        background-color: #218838;
        transform: scale(1.03);
    }

    .status-button-close-button {
        background-color: #dc3545;  
        color: white;
        border: 1px solid #c82333;
    }

    .status-button-close-button:hover {
        background-color: #c82333;
        transform: scale(1.03);
    }

    .status-button-open-button i,
    .status-button-close-button i {
        font-size: 12px;  
    }

</style>
<script>
    function toggleBranchStatus(rateId, status) {
        fetch(`/port/update-status/${rateId}`, {
            method: "PUT",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ status: status }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();  
            } else {
                console.error("Error updating status:", data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    }
</script>



<div id="editModal" class="modal1">
    <div class="modal-content1">
        <div class="modal-header1">
            <div class="inner">
                <h2 class="modal-title1">Update Shipping Rate</h2>
                <button class="close-btn" onclick="closeModal2()" aria-label="Close">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>

        <form id="editForm" method="POST" class="modal-body1">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="edit-origin">Origin</label>
                <input type="text" id="edit-origin" name="origin" required>
            </div>

            <div class="form-group">
                <label for="edit-destination">Destination</label>
                <input type="text" id="edit-destination" name="destination" required>
            </div>

            <div class="form-group">
                <label for="edit-price">Price (per kilo)</label>
                <input type="number" id="edit-price" name="price" required>
            </div>

            <div class="form-group">
                <label for="edit-delivery_days">Delivery Days</label>
                <input type="number" id="edit-delivery_days" name="delivery_days" required>
            </div>

            <div class="modal-footer1">
                <button type="submit" class="btn-blue">Update</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("editModal");
    const editBtns = document.querySelectorAll(".edit-btn");
    const form = document.getElementById("editForm");

    editBtns.forEach(btn => {
        btn.addEventListener("click", function (event) {
            event.preventDefault(); 

            const id = this.getAttribute("data-id");
            document.getElementById("edit-origin").value = this.getAttribute("data-origin");
            document.getElementById("edit-destination").value = this.getAttribute("data-destination");
            document.getElementById("edit-price").value = this.getAttribute("data-price");
            document.getElementById("edit-delivery_days").value = this.getAttribute("data-delivery_days");
 
            form.action = `/rates/update/${id}`;
 
            modal.style.display = "flex";
            setTimeout(() => modal.classList.add("show"), 10);
        });
    });
});
</script>
<script>
    function closeModal2() {
        const modal = document.getElementById("editModal");
        modal.classList.remove("show");
        modal.classList.add("hide");

        setTimeout(() => {
            modal.style.display = "none";
            modal.classList.remove("hide");
        }, 500);  
    }
 
    document.querySelector(".cancel-button").addEventListener("click", closeModal);
</script>

<script>
    window.addEventListener("click", function (event) {
        let addPortModal = document.getElementById('addPortModal');
        let editModal = document.getElementById('editModal');

        if (event.target === addPortModal) {
            closeModal1(); 
        } else if (event.target === editModal) {
            closeModal2(); 
        }
    });
</script>


<div id="deleteModal" class="modals" onclick="closeModal()">
    <div class="modal-contents" onclick="event.stopPropagation()">
        <h3>Are you sure you want to delete this shipping rate?</h3>
        <p>This action cannot be undone.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-buttons">
                <button type="submit" class="confirm-delete">Confirm</button>
                <button type="button" class="cancel-delete" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(rateId) {
        document.getElementById('deleteForm').action = '/port/' + rateId;  
        document.getElementById('deleteModal').classList.add('show');  
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.remove('show');  
    }
 
    document.addEventListener("keydown", function(event) {
        const modal = document.getElementById("deleteModal");

        if (modal.classList.contains("show") && event.key === "Escape") {
            closeModal();
        }
    });
 
    document.getElementById("deleteModal").addEventListener("click", closeModal);
</script>

<style>
    .modals {
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

    .modals.show {
        display: block;
        opacity: 1; 
    }

    .modal-contents {
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

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .confirm-delete, .cancel-delete {
        padding: 10px 25px;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .confirm-delete {
        background: linear-gradient(135deg, #2196F3, #1565C0); 
        color: #fff;
        box-shadow: 0 4px 10px rgba(33, 150, 243, 0.5);
        padding: 10px 30px;
        border-radius: 30px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .confirm-delete:hover {
        background: #1565C0;
        box-shadow: 0 6px 15px rgba(33, 150, 243, 0.8);
        transform: translateY(-2px);
    }

    .cancel-delete {
        background: linear-gradient(135deg, #F44336, #C62828);
        color: #fff;
        box-shadow: 0 4px 10px rgba(244, 67, 54, 0.5);
    }

    .cancel-delete:hover {
        background: #C62828;
        box-shadow: 0 6px 15px rgba(244, 67, 54, 0.8);
        transform: translateY(-2px);
    }
</style>

<script>
    function sortTable(n) {
        let table = document.getElementById("dataTable");
        let rows = Array.from(table.rows).slice(1);
        let asc = table.dataset.sortOrder !== "asc";

        rows.sort((row1, row2) => {
            let cell1 = row1.cells[n].textContent.trim();
            let cell2 = row2.cells[n].textContent.trim();
            return asc ? cell1.localeCompare(cell2) : cell2.localeCompare(cell1);
        });

        table.tBodies[0].append(...rows);
        table.dataset.sortOrder = asc ? "asc" : "desc";
    }
</script>

</body>
</html>