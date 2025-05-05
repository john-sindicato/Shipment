@extends('customer.layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .wrapper {
        width: 100%;
        max-width: 1170px;
        padding-top: 10px;
    }
    .message-container {  
        margin-bottom: 35px;
        border-radius: 10px; 
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.8s ease-out;
    }
 
    .message-container h2 {
        color: #000;
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 36px;
        font-weight: 100;
        position: relative;
        text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
    }

    @media (max-width: 768px) {
        .message-container h2 {
            font-size: 28px;
        }
    }

    @media (max-width: 480px) {
        .message-container h2 {
            font-size: 24px;
        }
    }

    .message-container p { 
        line-height: 1.6;
        margin-bottom: 15px;
        font-size: 1.1rem;
        text-align: justify;
    }
 
    .search-container {
        position: relative;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .search-input {
        width: 100%;
        padding: 16px 20px 16px 50px;
        border: 2px solid #d1d9e6;
        border-radius: 12px;
        font-size: 16px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.07);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #5b84c4;
        box-shadow: 0 0 0 4px rgba(91, 132, 196, 0.2), 0 8px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #5b84c4;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .search-input:focus + .search-icon {
        color: #3d5d8a;
    }

    .clear-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #7f8c9d;
        cursor: pointer;
        font-size: 16px;
        opacity: 0.7;
        transition: all 0.2s ease;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .clear-btn:hover {
        opacity: 1;
        background-color: rgba(127, 140, 157, 0.1);
        transform: translateY(-50%) scale(1.1);
    }
 
    .rates-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        perspective: 1000px;
    }
 
    .rate-item {
        background: #f5f7fa;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #ddd;
        transform-style: preserve-3d;
        position: relative;
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        animation-delay: calc(0.1s * var(--i, 0));
    }

    .rate-item:hover {
        transform: translateY(-8px) rotateX(5deg);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06);
    }

    .rate-header {
        background: linear-gradient(135deg, #5b84c4, #4a6fa5);
        color: #fff;
        padding: 18px 22px;
        font-size: 18px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .rate-header::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100%;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.2) 100%);
        transform: skewX(-20deg) translateX(180px);
        transition: transform 0.7s ease;
    }

    .rate-item:hover .rate-header::after {
        transform: skewX(-20deg) translateX(50px);
    }

    .rate-details {
        padding: 22px;
        min-height: 110px;
        position: relative;
        z-index: 1;
        background-color: rgba(255, 255, 255, 0.8);
    }

    .rate-details p {
        margin: 0;
        color: #000;
        position: relative;
        z-index: 1;
    }

    .route-unavailable {
        color: #e74c3c;
        font-weight: 500;
        text-align: center;
        padding: 15px;
        background: linear-gradient(to right, #fdf2f2, #fde8e8);
        margin: 0;
        border-top: 1px solid rgba(231, 76, 60, 0.2);
    }

    .rate-price-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 22px 22px;
        background-color: rgba(245, 247, 250, 0.7);
        border-top: 1px solid rgba(209, 217, 230, 0.5);
    }

    .rate-price {
        font-size: 20px;
        font-weight: 600;
        color: #000;
        position: relative;
    }

    .rate-price::before {
        content: "";
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #5b84c4;
        transition: width 0.3s ease;
    }

    .rate-item:hover .rate-price::before {
        width: 100%;
    }

    .request-quote-btn {
        background: linear-gradient(135deg, #5b84c4, #4a6fa5);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(74, 111, 165, 0.3);
        position: relative;
        overflow: hidden;
    }

    .request-quote-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.7s ease;
    }

    .request-quote-btn:hover {
        background: linear-gradient(135deg, #4a6fa5, #3d5d8a);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(74, 111, 165, 0.4);
    }

    .request-quote-btn:hover::before {
        left: 100%;
    }
 
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .wrapper {
            padding: 10px;  
        }
    }

    @media (max-width: 480px) {
        .wrapper {
            padding: 10px;
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

    @section('content')
    <div class="wrapper">
        <div class="message-container">
            <h2>Routes and Shipping Rates</h2>
            <p>Explore our local shipping routes with competitive prices based on weight and distance. Choose the best route for your needs, and contact us if you need any assistance. We're here to help you with your shipment options. Our local routes are designed to ensure efficient and cost-effective deliveries, tailored to suit both small and large shipments. Whether you're sending parcels across town or across the region, we offer flexible solutions to meet your needs. With our transparent pricing, you'll always know exactly what you're paying for, with no hidden fees. Additionally, our team of experienced logistics professionals is always available to provide guidance and support, ensuring a smooth experience from start to finish. Trust us to handle your local shipments with care, speed, and reliability, every step of the way.</p>
        </div>    

        <div class="search-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" id="search-bar" class="search-input" placeholder="Search routes..." oninput="searchFunction()">
            <span class="clear-btn" onclick="clearSearch()">✖</span>     
        </div>

        <div class="rates-container">
            @foreach ($rates as $row)
                @php
                    $random_message = $messages[array_rand($messages)];
                @endphp

                <div class="rate-item">
                    <div class="rate-header">{{ $row->origin }} to {{ $row->destination }} </div>
                    
                    @if ($row->status == 'close')
                        <div class="rate-details">
                            <p>Unfortunately, this route is currently unavailable. Please explore other options or contact us for assistance.</p>
                        </div>
                            <p class="route-unavailable">This route is currently unavailable.</p>
                    @elseif ($row->status == 'open')
                        <div class="rate-details">
                            <p>{{ $random_message }}</p>
                        </div> 
                        <div class="rate-price-container">
                            <div class="rate-price">PHP {{ $row->price }} per kg</div>
                            <a href="{{ route('request_form', ['origin' => $row->origin, 'destination' => $row->destination]) }}" class="request-quote-btn">Request a Quote</a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endsection
    
<script>
    function searchFunction() {
        const input = document.getElementById('search-bar');
        const filter = input.value.toUpperCase();
        const rateItems = document.querySelectorAll('.rate-item');
        
        rateItems.forEach((item, index) => {
            const text = item.textContent || item.innerText;
            if (text.toUpperCase().indexOf(filter) > -1) {
                item.style.display = "";
              
                item.style.animation = 'none';
                item.offsetHeight;  
                item.style.animation = `fadeInUp 0.6s ease-out forwards`;
                item.style.animationDelay = `${0.05 * index}s`;
            } else {
                item.style.display = "none";
            }
        });
        
        document.querySelector('.clear-btn').style.display = 
            input.value.length > 0 ? 'flex' : 'none';
    }

    function clearSearch() {
        const input = document.getElementById('search-bar');
        input.value = '';
        searchFunction();
        input.focus();
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.clear-btn').style.display = 'none';
        
        const rateItems = document.querySelectorAll('.rate-item');
        rateItems.forEach((item, index) => {
            item.style.setProperty('--i', index);
        });
    });
</script>
</body>
</html>
