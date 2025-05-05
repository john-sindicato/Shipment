<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
<style>
    .container {
        display: flex;
        flex-direction: column;
        width: 100%;
    } 

    .info-container {
        background-color: #f1f1f1;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 8px;
    }

    .info-column {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 2px 0;
        border-bottom: 1px solid #eaeaea;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #000;
        text-align: right;
        width: 20%;
        margin-right: 8px;
        word-wrap: break-word;
    }

    .info-values {
        color: #000;
        width: 80%;
        word-wrap: break-word;
    }

    @media (max-width: 600px) {
        .info-label {
            font-size: 10px;
            text-align: left;
            width: 100%;
            margin-right: 0;
        }

        .info-values {
            font-size: 10px;
            width: 100%;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .details-table th,
    .details-table td {
        padding: 6px 8px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .details-table th {
        background-color: #f1f1f1;
        font-weight: 600;
    }

    .details-table tbody tr:last-child td {
        border-bottom: none;
    }

    @media (max-width: 600px) {
        .info-label {
            font-size: 10px;
        }

        .info-values {
            font-size: 10px;
        }

        .details-table th,
        .details-table td {
            font-size: 8px;
        }
    }
</style>
</head>
<body>

         <div class="container">
            <div class="shipment-info">
                @php $currentUserId = null; @endphp
                @foreach ($shipment as $row)
                    @php
                        $userIdentifier = $row->shipment_id . '|' . $row->fname . '|' . $row->lname . '|' . $row->phone . '|' . $row->email;
                    @endphp
    
                    @if ($userIdentifier !== $currentUserId)
                        @php $currentUserId = $userIdentifier; @endphp
                    <div class="info-container">
                        <div class="info-column">
                            <div class='info-row'>
                                <span class='info-label'>Shipment Number:</span>
                                <span class='info-values'>{{ $row->shipment_id }}</span>
                            </div>
                            <div class='info-row'>
                                <span class='info-label'>First Name:</span>
                                <span class='info-values'>{{ $row->fname }}</span>
                            </div>
                            <div class='info-row'>
                                <span class='info-label'>Last Name:</span>
                                <span class='info-values'>{{ $row->lname }}</span>
                            </div>
                            <div class='info-row'>
                                <span class='info-label'>Phone Number:</span>
                                <span class='info-values'>{{ $row->phone }}</span>
                            </div>
                            <div class='info-row'>
                                <span class='info-label'>Email:</span>
                                <span class='info-values'>{{ $row->email }}</span>
                            </div>
                            <div class='info-row'>
                                <span class='info-label'>Address:</span>
                                <span class='info-values'>
                                    {{ $row->street }}, {{ $row->brgy }}, {{ $row->city }}, {{ $row->province }}, {{ $row->zipcode }}, {{ $row->region }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
    
            <table class="details-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Length (m)</th>
                        <th>Width (m)</th>
                        <th>Height (m)</th>
                        <th>Weight (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipment as $row)
                    <tr>
                        <td>{{ $row->category }}</td>
                        <td>{{ $row->length }}</td>
                        <td>{{ $row->width }}</td>
                        <td>{{ $row->height }}</td>
                        <td>{{ $row->weight }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         
        </div>
    </div>
    
    
</body>
</html>
 