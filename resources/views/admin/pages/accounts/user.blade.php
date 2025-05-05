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



<style>     
    .container1 {
        margin-top: 70px;
        background-color: #fff;   
        border: 2px solid #ddd;
        border-radius: 8px;  
        /*box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);*/  
        width: 100%;  
        height: 100%;
        overflow: hidden;  
    }

    .table-container {
        background-color: #fff;
        padding: 30px; 
        height: 100vh; 
        max-height: 537px; 
    }
    
    .table-wrapper {
        overflow-y: auto;
        max-height: 508px;
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
                margin: 30% auto; 
            }
        }
        @media (max-width: 768px) {
            .container1 {
                margin: 30% auto; 
            }
        }
        @media (max-width: 480px) {
            .container1 {
                margin: 40% auto; 
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
                        <th>#</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->fname }}</td>
                        <td>{{ $user->lname }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>    
                        <td class="actions">
                            <button class="delete-btn tooltip" onclick="openModal({{ $user->id }})">
                                <i class="fas fa-trash-alt"></i>
                                <span class="tooltiptext">Delete</span>
                            </button>
                        </td>       
                    </tr>
                    @empty 
                        <tr>
                            <td colspan='6' style='text-align:center;'>No User found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        @if($users->isNotEmpty())
            <div class="pagination-container">
                <div class="pagination-links">
                    {{ $users->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            
                <div class="results-summary">
                    Showing {{ $users->count() }} out of {{ $users->total() }} User(s)
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

<div id="deleteModal" class="modals">
    <div class="modal-contents">
        <h3>Are you sure you want to delete this user?</h3>
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
    function openModal(userId) {
        document.getElementById('deleteForm').action = '/users/' + userId;  
        document.getElementById('deleteModal').classList.add('show');  
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.remove('show');  
    }

    document.getElementById('deleteModal').addEventListener('click', closeModal);
</script>

</body>
</html>