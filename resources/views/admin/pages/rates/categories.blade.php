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
<style>
    body{
        overflow: hidden;
    }

    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        margin-top: 73px;
        left: 240px; 
        transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
        gap: 40px;
        background: transparent;
        padding: 10px 20px;
        border-radius: 8px; 
        width: calc(100% - 240px);
    }
    
    .add-new {
        display: flex;
        align-items: center;
        gap: 10px;
        background-color: #fff;
        padding: 8px 12px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    .input-box {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 10px;
        width: 180px;
        font-size: 14px;
    }

    #add-new-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
    }

    #add-new-btn:hover {
        background-color: #0056b3;
    }
        
    .weight-limit {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fff;
        padding: 10px 14px;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }
    
    .weight-label {
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }
    
    input[type="range"] {
        -webkit-appearance: none;
        width: 180px;  
        height: 6px;
        background: #007bff;
        border-radius: 3px;
        outline: none;
        cursor: pointer;
    }
    
    #weight-value {
        font-weight: bold;
        font-size: 14px;
        padding: 4px 10px;
        background: #e9ecef;
        border-radius: 5px;
        color: #007bff;
        min-width: 50px;
        text-align: center;
    }
    
    #save-weight-btn {
        background: #007bff;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    #save-weight-btn:hover {
        background: #0056b3;
    }

    .input-box {
        padding: 10px;
        font-size: 14px;
        width: 300px;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        background-color: #f4f4f4;
        transition: all 0.3s ease;
        z-index: 0;
    }

    .input-box:focus {
        background-color: #fff;
        box-shadow: 0 0 5px #007BFF;
    }

    #add-new-btn {
        padding: 10px 15px;
        background-color: #007BFF; 
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        z-index: 0;
    }

    #add-new-btn:hover {
        background-color: #0056b3;
    }
    
    @media (max-width: 768px) {
        .topbar {
            flex-direction: column;
            align-items: center;
            width: 100%;
            left: 0;
            margin-top: 70px;
            padding: 8px;
            gap: 10px;
        }
 
        .weight-limit {
            width: 90%;
            justify-content: center;
            padding: 6px 10px;
        }
 
        #save-weight-btn {
            font-size: 12px;
            padding: 5px 10px;
        }

        .weight-label,
        #weight-value {
            font-size: 12px;
        }

        input[type="range"] {
            width: 100px;
        }
    }

    @media (max-width: 480px) {
        .topbar {
            flex-direction: column;
            align-items: center;
            width: 100%;
            left: 0;
            margin-top: 60px;
            padding: 6px;
            gap: 0px;
        }
 
        .weight-limit {
            width: 100%;
            padding: 5px 8px;
        }
  
        #save-weight-btn {
            font-size: 11px;
            padding: 4px 8px;
        }

        .weight-label,
        #weight-value {
            font-size: 11px;
        }

        input[type="range"] {
            width: 80px;
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

        .add-new {
            width: 100%;
            justify-content: center;
            height: 50%;
            margin: 2% auto;
            z-index: 0;
        }

        .input-box {
            width: 70%;
        }
    }

    @media (max-width: 480px) {
        .topbar {
            align-items: center;
            text-align: center;
            left: 0;
        }

        .input-box {
            width: 100%;
        }

        #add-new-btn {
            width: 30%;
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
    
 
    <div class="topbar">
        <form action="{{ route('categories.store') }}" method="POST" class="add-new">
            @csrf
            <input type="text" id="new-input" name="category" placeholder="Enter category..." class="input-box" required>
            <button type="submit" id="add-new-btn"><i class="fas fa-plus"></i> Add</button>
        </form>
    
        <div class="weight-limit">
            <form action="{{ route('weight.store') }}" method="POST" id="weight-form">
                @csrf
                <label for="weight-range" class="weight-label">Weight Limit:</label>
                <input type="range" id="weight-range" name="weight" min="1" max="1000">
                <span id="weight-value">0kg</span>
                <button type="submit" id="save-weight-btn"><i class="fas fa-save"></i> Save</button>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('weight.get') }}")
                .then(response => response.json())
                .then(data => {
                    if (data.weight) {
                        document.getElementById("weight-range").value = data.weight;
                        document.getElementById("weight-value").textContent = data.weight + "kg";
                    }
                })
                .catch(error => console.error("Error fetching weight limit:", error));
        });
    
        document.getElementById("weight-range").addEventListener("input", function () {
            document.getElementById("weight-value").textContent = this.value + "kg";
        });
    </script>
    
   
    
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

<style>     
    .container1 {
        background-color: #fff;   
        border: 2px solid #ddd;
        border-radius: 8px;  
        /*box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);*/  
        width: 100%;  
        height: 100%;
        overflow: hidden;  
        margin-top: 130px; 
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

    .thead {
        width: 0%;
    }

    .thead2 {
        width: 100%;
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
        max-width: 50px;
    }

    .actions {
        display: flex;
        justify-content: left;
        align-items: left;
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


    .view-btn,
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
            .container1 {
                margin: 70% auto;
                margin-bottom: 8px;
            }
        }
        @media (max-width: 768px) { 
            .container1{
                margin: 70% auto;
                margin-bottom: 8px;
            }
        }
        @media (max-width: 480px) { 
            .container1{
                margin: 70% auto;
                margin-bottom: 8px;
            }
        }
</style> 

@section('content')
<div class="container1">
    <div class="table-container">
        <div class="table-wrapper">
            <table class="custom-table" id="table">
                <thead>
                    <tr>
                        <th class="thead">#</th>
                        <th class="thead2">Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->category }}</td>
                        <td class="actions">
                            <a href="javascript:void(0);" class="edit-btn tooltip" data-id="{{ $category->id }}" 
                                data-category="{{ $category->category }}">
                                <i class="fas fa-edit"></i> 
                                <span class="tooltiptext">Edit</span>
                            </a>

                            <button class="delete-btn tooltip" onclick="openModal({{ $category->id }})">
                                <i class="fas fa-trash-alt"></i> 
                                <span class="tooltiptext">Delete</span>
                            </button>
                        </td>       
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3" style='text-align:center;'>No Categories Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        @if($categories->isNotEmpty())
            <div class="pagination-container">
                <div class="pagination-links">
                    {{ $categories->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            
                <div class="results-summary">
                    Showing {{ $categories->count() }} out of {{ $categories->total() }}  categories
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
</style>



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
        padding: 10px 16px;
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
<div id="editModal" class="modal1">
    <div class="modal-content1">
        <div class="modal-header1">
            <div class="inner">
                <h2 class="modal-title1">Update Category</h2>
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
                <label for="edit-category">Category</label>
                <input type="text" id="edit-category" name="category" required>
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
        btn.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            document.getElementById("edit-category").value = this.getAttribute("data-category");
    
            form.action = `/category/update/${id}`;

            modal.style.display = "flex";
            setTimeout(() => modal.classList.add("show"), 10);
        });
    });
});
</script>

<script>
    window.addEventListener("click", function (event) {
        let editModal = document.getElementById('editModal');

        if (event.target === editModal) {
            closeModal2(); 
        }
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



<div id="deleteModal" class="modals" onclick="closeModal()">
    <div class="modal-contents" onclick="event.stopPropagation()">
        <h3>Are you sure you want to delete this category?</h3>
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
    function openModal(categoryId) {
        document.getElementById("deleteForm").action = "/categories/" + categoryId;
        document.getElementById("deleteModal").classList.add("show");
    }

    function closeModal() {
        document.getElementById("deleteModal").classList.remove("show");
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
</body>
</html>