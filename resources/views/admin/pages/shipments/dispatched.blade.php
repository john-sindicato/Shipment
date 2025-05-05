@extends('admin.layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
        border-bottom: 1px solid #e0e0e0;
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


@section('content')
<div class="container1">
    <div class="table-container">
        <div class="table-wrapper">
            @if($shipments->isEmpty())
                <div class="empty-state">
                    <img src="{{ asset('img/no_shipment.png') }}" alt="No Shipments" class="empty-image">
                    <p class="empty-note">No Shipment Found</p>
                </div>
            @else
                <table class="custom-table" id="table">
                    <thead>
                        <tr>
                            <th>Shipment Number</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Dispatch Date</th>
                            <th>Arrival Date</th>
                            <th>View Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->shipment_id }}</td>
                                <td>{{ $shipment->origin }}</td>
                                <td>{{ $shipment->destination }}</td>
                                <td>{{ \Carbon\Carbon::parse($shipment->dispatch_date)->format('F d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($shipment->arrival_date)->format('F d, Y') }}</td>
                                <td>
                                    <button class='view-btn' 
                                            type="button"
                                            data-id='{{ $shipment->shipment_id }}'>
                                        <i class='fa fa-eye' aria-hidden='true'></i> View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>    
    <div class="page">
        @if($shipments->isNotEmpty())
            <div class="pagination-container">
                <div class="pagination-links">
                    {{ $shipments->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            
                <div class="results-summary">
                    Showing {{ $shipments->count() }} out of {{ $shipments->total() }} shipment(s)
                </div>            
            </div>
        @endif
    </div>        
</div>
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
   .modal1 {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);  
        justify-content: center;  
        align-items: center;
        z-index: 9999;  
        opacity: 0;         
        transition: opacity 0.3s ease;  
    }

    .modal1.active {
        display: flex;
        opacity: 1;  
    }

    .modal-content1 {
        background-color: #fff;
        padding: 30px;
        width: 60%;
        border-radius: 10px;
        position: relative;
        z-index: 10000;  
        overflow-y: auto;
        overflow-x: hidden;
        max-height: 95vh;
        transform: translateY(-50px);   
        opacity: 0;                     
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .modal-content1::-webkit-scrollbar {
        width: 8px; 
    }

    .modal-content1::-webkit-scrollbar-track {
        background: transparent;   
    }

    .modal-content1::-webkit-scrollbar-thumb {
        background: #d3d3d3;  
        border-radius: 10px;  
    }

    .modal-content1::-webkit-scrollbar-thumb:hover {
        background: #a9a9a9;  
    }

    .modal1.active .modal-content1 {
        transform: translateY(0);   
        opacity: 1;
    }


    .close-btn {
        position: absolute;  
        top: 0;
        margin-left: auto;
        font-size: 28px;
        cursor: pointer;
        color: #333;
        background-color: #f1f1f1; 
        border: 2px solid #4169E1;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: sticky;
        margin-right: -20px;
        margin-top: -30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .close-btn:hover {
        background-color: #4169E1;
        color: #fff;
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .modal-content1 {
            width: 90%;
        }
    }

</style>

<div id="shipmentModal" class="modal1">
    <div class="modal-content1">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <div id="modal-body">Loading shipment details...</div>
    </div>
</div>

<script>
    const modal = document.getElementById("shipmentModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const modalBody = document.getElementById("modal-body");

    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const shipmentId = this.getAttribute('data-id');

            fetch(`/admin/pages/shipments/details/dispatched/${shipmentId}`)
                .then(response => response.text())
                .then(data => {
                    modalBody.innerHTML = data;
                    modal.style.display = "flex";

                    setTimeout(() => modal.classList.add('active'), 10);
                })
                .catch(error => console.error("Error fetching data:", error));
        });
    });

    closeModalBtn.onclick = function () {
        closeModal();
    };

    modal.addEventListener('click', function (event) {
        if (!event.target.closest('.modal-content1')) {
            closeModal();
        }
    });

    function closeModal() {
        modal.classList.remove('active');

        setTimeout(() => modal.style.display = "none", 400); 
    }

</script>

<script>
    document.getElementById('select-all').addEventListener('change', function () {
        const visibleRows = document.querySelectorAll('#table tbody tr:not([style*="display: none"]) .user-checkbox');
        visibleRows.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    function updateSelectAllState() {
        const visibleCheckboxes = document.querySelectorAll('#table tbody tr:not([style*="display: none"]) .user-checkbox');
        const selectAllCheckbox = document.getElementById('select-all');
        selectAllCheckbox.checked = visibleCheckboxes.length > 0 && [...visibleCheckboxes].every(cb => cb.checked);
    }

    document.querySelectorAll('.user-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectAllState);
    });

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

        updateSelectAllState();
    }

    function clearSearch() {
        const input = document.getElementById("search1");
        input.value = "";
        search();  
    }
</script>
@endsection

</body>
</html>
