@extends('teller.layout.layout')

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

        .submit-container {
            display: flex;
            justify-content: flex-start;
            margin: 6% auto;
            margin-bottom: 10px;
            gap: 10px;
        }

        .submit-btn {
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

        .submit-btn i {
            font-size: 16px;
            color: #555;
        }

        .submit-btn:hover {
            background-color: #f5f5f5;
            border-color: #bbb;
        }

        .submit-btn:active {
            background-color: #eaeaea;
            border-color: #999;
        }

        @media (max-width: 1024px) {
            .submit-container {
                margin-bottom: 10px;
                margin-left: 0;
                width: 100%;
                height: 100%;
                max-width: 100%;
                margin-top: 160px;
                font-size: 10px;
            }

            .submit-btn {
                padding: 6px 12px; 
                font-size: 12px;    
                gap: 5px;   
            }

            .submit-btn i {
                font-size: 14px; 
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



<style>
    .modal {
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

    .modal.show {
        display: block;
        opacity: 1; 
    }

    .modal-content {
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

    .modal-content.close {
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

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .confirm-btn, .cancel-btn {
        padding: 10px 25px;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .confirm-btn {
        background: linear-gradient(135deg, #2196F3, #1565C0); 
        color: #fff;
        box-shadow: 0 4px 10px rgba(33, 150, 243, 0.5);
        border: none;
        padding: 10px 30px;
        border-radius: 30px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .confirm-btn:hover {
        background: #1565C0;
        box-shadow: 0 6px 15px rgba(33, 150, 243, 0.8);
        transform: translateY(-2px);
    }

    .cancel-btn {
        background: linear-gradient(135deg, #F44336, #C62828);
        color: #fff;
        box-shadow: 0 4px 10px rgba(244, 67, 54, 0.5);
    }

    .cancel-btn:hover {
        background: #C62828;
        box-shadow: 0 6px 15px rgba(244, 67, 54, 0.8);
        transform: translateY(-2px);
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.querySelector('.submit-btn');
        const checkboxes = document.querySelectorAll('.user-checkbox');
        const modal = document.getElementById('confirmationModal');
        const modalContent = document.querySelector('.modal-content');
        const confirmSubmit = document.getElementById('confirmSubmit');
        const cancelSubmit = document.getElementById('cancelSubmit');
        const form = document.querySelector('form');

        submitBtn.addEventListener('click', function (event) {
            handleSubmission(event);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();   
                handleSubmission(event);
            }
        });

        function handleSubmission(event) {
            const isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

            if (!isAnyChecked) {
                event.preventDefault();

                const alertBox = document.createElement('div');
                alertBox.className = 'error_alert';
                alertBox.innerHTML = `Please select at least one shipment before submitting.`;
                document.body.appendChild(alertBox);

                setTimeout(() => {
                    alertBox.classList.add('hide');
                    setTimeout(() => alertBox.remove(), 500);
                }, 3000);
            } else {
                event.preventDefault();
                modal.classList.add('show'); 
            }
        }

        confirmSubmit.addEventListener('click', function () {
            form.submit();
        });

        cancelSubmit.addEventListener('click', function () {
            closeModal();
        });

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        function closeModal() {
            modalContent.classList.add('close');
            setTimeout(() => {
                modal.classList.remove('show');
                modalContent.classList.remove('close');
            }, 300);
        }
    });
</script>

<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <h2>Are you sure?</h2>
        <p>Once submitted, you won't be able to undo this action.</p>
        <div class="modal-buttons">
            <button id="confirmSubmit" class="confirm-btn">Submit</button>
            <button id="cancelSubmit" class="cancel-btn">Cancel</button>
        </div>
    </div>
</div>


@section('content')
<form method="POST" action="{{ route('shipment_dispatched') }}">
    @csrf
    <div class="submit-container">
        <button type="button" class="submit-btn">
            <i class="fas fa-clipboard-check"></i> Dispatch
        </button>
    </div>
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
                                <th><input type='checkbox' id='select-all'> Select All</th>
                                <th>Shipment Number</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Dispatch Date</th>
                                <th>Expected Delivery Date</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipments as $shipment)
                                <tr>
                                    <td>
                                        <input type='checkbox' class='user-checkbox' name='user_ids[]' value='{{ $shipment->shipment_id }}'>
                                    </td>
                                    <td>{{ $shipment->shipment_id }}</td>
                                    <td>{{ $shipment->origin }}</td>
                                    <td>{{ $shipment->destination }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shipment->dispatch_date)->format('F d, Y') }}</td>
                                    @php
                                        $dates = explode(' - ', $shipment->expected_delivery_date); 
                                        $formattedStartDate = \Carbon\Carbon::parse($dates[0])->format('F d, Y');
                                        $formattedEndDate = \Carbon\Carbon::parse($dates[1])->format('F d, Y');
                                    @endphp
                                    <td>{{ $formattedStartDate }} - {{ $formattedEndDate }}</td>
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
</form>
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

            fetch(`/teller/pages/details/in_transit/${shipmentId}`)
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
