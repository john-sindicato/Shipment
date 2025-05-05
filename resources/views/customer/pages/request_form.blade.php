@extends('customer.layout.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style> 
    .container {
        width: 100%;    
        max-width: 1170px;  
        padding-top: 10px;
        font-family: "Segoe UI", "Arial", sans-serif;
        color: #333;
        background-color: white;
        border-radius: 8px; 
    }

    h2 {
        color: #000;
        margin-bottom: 20px;
        font-size: 1.6rem;
        font-weight: 600;  
    }

    /* Form layout */
    .form-group {
        display: flex;
        gap: 25px; 
    }

    .form-column {
        flex: 1;
    }

    .form-columns {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }

    .dimension {
        flex: 1;
        min-width: 120px;
    }

    /* Input styles */
    input,
    select {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border: 2px solid #d0d9e6;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.2s ease;
        background-color: #fff;
    }

    input:hover,
    select:hover {
        border-color: #a3c2f5;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: #1a73e8;
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.25);
    }

    input[readonly] {
        background-color: #f0f4fa;
        border-color: #c0cde0;
        cursor: not-allowed;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #000;
        font-size: 15px;
    }

    /* Route section */
    .route-container {
        display: flex;  
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        padding: 2rem;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.08); /* Neutral shadow */
    }

    .form-column.full {
        width: 100%;
        max-width: 400px;
    }

    .form-column.full label {
        font-weight: 600;
        color: #000000; /* Label is now black */
        margin-bottom: 0.3rem;
    }

    .input-with-icon {
        position: relative;
        width: 100%;
    }

    .input-with-icon i {
        position: absolute;
        top: 35%;
        left: 12px;
        transform: translateY(-50%);
        color: #007bff;
        font-size: 1rem;
    }

    .input-with-icon input {
        width: 100%;
        padding: 10px 10px 10px 38px;   
        border-radius: 8px;
        background-color: #ffffff;
        font-size: 1rem;
    }

    .swapButton {
        display: flex;
        align-items: center; 
        background-color: #007bff;
        color: white;
        padding: 8px 14px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .swapButton i {
        margin-right: 10px;
    }

    .swapButton:hover {
        background-color: #0056b3;
    }

    /* Sender and Shipment sections */
    .sender,
    .shipment_info { 
        padding: 40px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.08); 
        transition: box-shadow 0.3s;
    }

    /* Category section */
    #category-container {
        margin-bottom: 20px;
    }

    .form-groups {
        background-color: #f8faff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #e0e7f2;
        transition: all 0.3s;
    }
        
    .category {
        position: relative;
        width: 100%;
        max-width: 400px;
        align-items: center;
    }

    .category select {
        width: 100%;
        display: block;
        appearance: none;
        color: #555;  
        cursor: pointer;
    }
    
    .category::after {
        content: "";
        position: absolute;
        top: 70%;
        right: 12px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #555;   
        transition: transform 0.2s ease; 
    }
 
    .category.open::after {
        transform: translateY(-50%) rotate(180deg);  
    }

    .category select option:disabled {
        color: #888;              
        background-color: #f0f0f0;   
        font-weight: bold;
    }

    .category option {
        color: black;
    }


    .add-category-btn {
        padding: 8px 16px;
        background: #1a73e8;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        }

    .add-category-btn:hover {
        background-color: #0d62d0;
        box-shadow: 0 6px 8px rgba(26, 115, 232, 0.3);
        transform: translateY(-1px);
    }

    .add-category-btn i {
        margin-right: 5px;
    }

    .remove-category-btn {
        margin-top: 10px;
        padding: 8px 16px;
        background-color: white;
        color: #000;
        border: 1px solid #000;
        transition: all 0.3s;       
        border-radius: 6px;
    }

    .remove-category-btn:hover {
        background-color: #f5f8ff;
        color: #000;
        box-shadow: 0 4px 8px rgba(66, 133, 244, 0.15);
        transform: translateY(-2px);
    }

    /* Buttons */
    .buttons {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 25px;
    }

    .btn-submit{
        padding: 14px 28px;
        border: none;
        border-radius: 2px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        letter-spacing: 0.5px;
    }

    .btn-submit {
        background-color: #1a73e8;
        color: white;
        box-shadow: 0 4px 6px rgba(26, 115, 232, 0.2);
    }

    .btn-submit:hover {
        background-color: #0d62d0;
        box-shadow: 0 6px 8px rgba(26, 115, 232, 0.3);
        transform: translateY(-2px);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .form-group {
            flex-direction: column;
            gap: 0;
        }

        .form-columns {
            flex-direction: column;
        }

        .dimension {
            width: 100%;
        }

        .buttons {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
        }
    }
</style>
</head>
<body>
    <style>
        /* Additional matte color options you might want to use */
        /* 
        Matte Color Palette:
        - Matte Green: #7aad7a (hover: #658d65)
        - Matte Purple: #9a7cb0 (hover: #7f6691)
        - Matte Orange: #d89667 (hover: #b87c55)
        - Matte Teal: #5a9a9a (hover: #4a7f7f)
        - Matte Yellow: #d6c069 (hover: #b3a057)
        - Matte Gray: #8c8c8c (hover: #747474)
        */
        .subtopbar {  
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 6px;
            margin-top: -20px;
        }

        .subtopbar h2 {
            margin: 1% auto;
            font-size: 30px;
            font-weight: 800;
            color: #000;
        }

        @media (max-width: 768px) {
            .subtopbar {
                padding: 10px 20px;
                margin-bottom: 15px; 
            }

            .subtopbar h2 {
                font-size: 24px;
                text-align: center;
            }
        }

        :root {
            --primary: #007bff;
            --primary-light: #e0f0ff;
            --gray-300: #d1d5db;
            --gray-500: #6b7280;
            --gray-100: #f3f4f6;
        }

        .form-progress-wrapper {
            margin-bottom: 1rem;
            padding: 1rem;
            max-width: 600px;        
            margin-left: auto;   
            margin-right: auto; 
        }


        .form-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border: 3px solid var(--gray-300);
            background-color: white;
            color: var(--gray-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .step-label {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: var(--gray-500);
        }

        /* Line between steps */
        .progress-line {
            flex: 1;
            height: 3px;
            background-color: var(--gray-300);
            margin: 0 10px;
            z-index: 1;
        }

        /* Active & Complete States */
        .progress-step.active .step-icon {
            border-color: var(--primary);
            color: var(--primary);
        }

        .progress-step.active .step-label {
            color: var(--primary);
        }

        .progress-step.complete .step-icon {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .progress-step.complete .step-label {
            color: var(--primary);
        }

        .progress-line.active {
            background-color: var(--primary);
        }
    </style>

    <style>
        .step-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .step-buttons button {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .step-buttons button i {
            margin-right: 8px;
            margin-left: 8px;
        }

        .step-buttons .btn-back {
            background-color: transparent; 
            color: #000;  
            justify-content: flex-start;
            margin-right: auto;
            border: 1px solid #000;
        }

        .step-buttons .btn-next {
            background-color: #000;  
            color: white;
            justify-content: flex-end;
        }

        .step-buttons .btn-back:hover {
            background: #f5f7fa;
        }

        .step-buttons .btn-next:hover {
            background-color: #333; / 
        }
    </style>

    <style>
        .buttons {
            display: flex;
            justify-content: space-between; 
            margin-top: 20px;
            gap: 15px;
        }

        .buttons button {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .buttons button i {
            margin-right: 8px;
            margin-left: 8px;
        }

        .buttons .btn-back {
            background-color: transparent;
            color: #000;
            justify-content: flex-start;
            border: 1px solid #000;
        }

        .buttons .btn-submit {
            background-color: #1a73e8;
            color: white;
            justify-content: flex-end;
            transition: all 0.3s ease;
        }

        .buttons .btn-back:hover {
            background: #f5f7fa;
        }

        .buttons .btn-submit:hover {
            background-color: #0d62d0;
            box-shadow: 0 4px 6px rgba(26, 115, 232, 0.3);
            transform: translateY(-2px);
        }

        .buttons .btn-submit:active {
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            .buttons {
                flex-direction: row;  
                justify-content: space-between;
            }
            .buttons .btn-submit {
                width: 35%;  
            }
        }
    </style>   

    <style>
        .description {
            font-size: 0.875rem;  
            margin-top: -10px;
            color: #555;  
            margin-bottom: 20px;  
        }
    </style>


<div id="senderAddressAlert" class="custom-alert">
    <div class="alert-content">
        <span class="close-btn" onclick="closeAlert('senderAddressAlert')">&times;</span>
        <h3>Sender Address Incomplete</h3>
        <p>Please fill out all required fields in the Sender Address section.</p>
    </div>
</div>

<div id="cargoDetailsAlert" class="custom-alert">
    <div class="alert-content">
        <span class="close-btn" onclick="closeAlert('cargoDetailsAlert')">&times;</span>
        <h3>Cargo Details Incomplete</h3>
        <p>Please fill out all required fields in the Cargo Details section.</p>
    </div>
</div>
<style> 
    .custom-alert {
        display: none;  
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);  
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .custom-alert .alert-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .custom-alert h3 {
        margin-bottom: 10px;
        color: #ff5722;
    }

    .custom-alert p {
        margin-bottom: 20px;
        color: #333;
    }

    .custom-alert .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }
    
    .custom-alert.show {
        display: flex;
    }
    
    .custom-alert .alert-content {
        transition: transform 0.3s ease-out;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("multiStepForm");
        const submitButton = form.querySelector(".btn-submit");

        submitButton.addEventListener("click", function (event) {
            let isFormValid = true;
 
            const senderFields = document.querySelectorAll('.sender input[required]');
            senderFields.forEach(function(field) {
                if (field.value.trim() === "") {
                    isFormValid = false;
                }
            });
 
            const cargoFields = document.querySelectorAll('.shipment_info input[required], .shipment_info select[required]');
            cargoFields.forEach(function(field) {
                if (field.value.trim() === "" || field.value === null) {
                    isFormValid = false;
                }
            });
 
            if (!isFormValid) {
                event.preventDefault();  
                if (isSenderIncomplete(senderFields)) {
                    showAlert('Please fill out all required fields in the Sender Address section.');
                } else if (isCargoIncomplete(cargoFields)) {
                    showAlert('Please fill out all required fields in the Cargo Details section.');
                }
            }
        });
    });
 
    function showAlert(alertId) {
        document.getElementById(alertId).classList.add("show");
    }
 
    function closeAlert(alertId) {
        document.getElementById(alertId).classList.remove("show");
    }
 
    function isSenderIncomplete(fields) {
        return Array.from(fields).some(field => field.value.trim() === "");
    }
 
    function isCargoIncomplete(fields) {
        return Array.from(fields).some(field => field.value.trim() === "" || field.value === null);
    }
</script>

@section('content')
<div class="wrapper">
    <div class="container">
        <div class="subtopbar"> 
            <h2>Get Your Shipping Quote</h2>
        </div>
        <div class="form-progress-wrapper">
            <div class="form-progress">
                <div class="progress-step" id="stepRoute">
                    <div class="step-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <span class="step-label">Route</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step" id="stepSender">
                    <div class="step-icon"><i class="fas fa-user"></i></div>
                    <span class="step-label">Sender</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step" id="stepCargo">
                    <div class="step-icon"><i class="fas fa-box"></i></div>
                    <span class="step-label">Cargo</span>
                </div>
            </div>
        </div>
        
        <form id="multiStepForm" action="{{ route('request.store') }}" method="POST">
            @csrf
            <div class="form-step active">
                <h2>Route</h2>  
                <p class="description">You can switch the origin and destination.</p>
                <div class="route-container">
                    <div class="form-column full">
                        <label for="origin">Origin</label>
                        <div class="input-with-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="origin" name="origin" value="{{ $origin }}" readonly />
                        </div>
                    </div>
            
                    <div class="form-column full">
                        <label for="destination">Destination</label>
                        <div class="input-with-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="destination" name="destination" value="{{ $destination }}" readonly />
                        </div>
                    </div>
            
                    <div class="swap-button-wrapper">
                        <button id="swapButton" type="button" aria-label="Swap Ports" class="swapButton">
                            <i class="fas fa-exchange-alt"></i> Switch Route
                        </button>
                    </div>
                </div>
            
                <div class="step-buttons">
                    <button type="button" class="btn-back" onclick="window.location.href='{{ route('routes') }}'">Cancel</button>
                    <button type="button" class="btn-next">Next <i class="fas fa-arrow-right"></i></button>
                </div>                
            </div>             
            <script>
                const swapButton = document.getElementById("swapButton");

                swapButton.addEventListener("click", function() {
                    const originInput = document.getElementById("origin");
                    const destinationInput = document.getElementById("destination");
                    
                    [originInput.value, destinationInput.value] = [destinationInput.value, originInput.value];

                    const icon = swapButton.querySelector("i");
                    icon.classList.add("rotate");

                    setTimeout(() => {
                        icon.classList.remove("rotate");
                    }, 500); 
                });
            </script>
             
            <div class="form-step">  
                <h2>Sender Address</h2>
                <p class="description">Please provide the address details of the sender.</p>
                <div class="sender">
                    <div class="form-group">
                        <div class="form-column">
                            @if(Auth::check())
                                <input type="hidden" name="fname" value="{{ Auth::user()->fname }} " readonly>
                                <input type="hidden" name="lname" value="{{ Auth::user()->lname }}" readonly>
                                <input type="hidden" name="phone" value="{{ Auth::user()->phone }}" readonly>
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}" readonly>     
                            @else
                                <span class="username">Guest</span> 
                            @endif
                            <label>Street</label>
                            <input type="text" name="street" placeholder="Enter street" required>

                            <label>Subdivision / Barangay</label>
                            <input type="text" name="brgy" placeholder="Enter subdivision / barangay" required>

                            <label>City</label>
                            <input type="text" name="city" placeholder="Enter city" required>
                        </div>

                        <div class="form-column">
                            <label>Province</label>
                            <input type="text" name="province" placeholder="Enter province" required>

                            <label>Postal / Zipcode</label>
                            <input type="number" name="zipcode" placeholder="Enter postal code" required>

                            <label>Region</label>
                            <input type="number" name="region" placeholder="Enter region" required>
                        </div>
                    </div>
                </div> 
                <div class="step-buttons">
                    <button type="button" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                    <button type="button" class="btn-next">
                        Next <i class="fas fa-arrow-right"></i>
                    </button>
                </div>                
            </div>

            <div class="form-step"> 
                <h2>Cargo Details</h2>
                <p class="description">Provide the details of your cargo for shipping.</p>
                <div class="shipment_info">
                    <div id="category-container">
                        <div class="form-groups">
                            <div class="category">
                                <label>Category</label>
                                <select name="category[]" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>                
                            </div>                    
                            
                            <div class="form-columns">
                                <div class="dimension">
                                    <label>Length (m)</label>
                                    <input type="number" name="length[]" placeholder="Enter length" required>
                                </div>
                                <div class="dimension">
                                    <label>Width (m)</label>
                                    <input type="number" name="width[]" placeholder="Enter width" required>
                                </div>
                                <div class="dimension">
                                    <label>Height (m)</label>
                                    <input type="number" name="height[]" placeholder="Enter height" required>
                                </div>
                                <div class="dimension">
                                    <label>Weight (kg)</label>
                                    <input type="number" id="weight" name="weight[]" placeholder="Enter weight" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="add-category-btn" type="button" onclick="addCategory()">
                        <i class="fas fa-plus"></i> Add Category (<span id="category-count">1</span>)
                    </button>    
                </div>
                <div class="buttons">
                    <button type="button" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </div>
        </form> 
    </div>
</div>
<style>
    .form-step {
        display: none;
    }
    .form-step.active {
        display: block;
    }
    .step-buttons {
        margin-top: 20px;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }
</style>
<script>
    const steps = document.querySelectorAll(".form-step");
    const nextBtns = document.querySelectorAll(".btn-next");
    const backBtns = document.querySelectorAll(".btn-back");
    let currentStep = 0;

    const indicators = {
        route: document.getElementById("stepRoute"),
        sender: document.getElementById("stepSender"),
        cargo: document.getElementById("stepCargo"),
    };

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle("active", i === index);
        });

        updateProgress();
    }

    function updateProgress() {
        // Check Route filled
        const origin = document.getElementById("origin").value;
        const destination = document.getElementById("destination").value;
        indicators.route.classList.toggle("complete", origin && destination);
        indicators.route.classList.toggle("active", currentStep === 0);

        // Check Sender filled
        const street = document.querySelector("[name='street']").value;
        const brgy = document.querySelector("[name='brgy']").value;
        const city = document.querySelector("[name='city']").value;
        const province = document.querySelector("[name='province']").value;
        const zipcode = document.querySelector("[name='zipcode']").value;
        const region = document.querySelector("[name='region']").value;
        const senderFilled = street && brgy && city && province && zipcode && region;
        indicators.sender.classList.toggle("complete", senderFilled);
        indicators.sender.classList.toggle("active", currentStep === 1);

        // Check Cargo filled
        const category = document.querySelector("[name='category[]']").value;
        const length = document.querySelector("[name='length[]']").value;
        const width = document.querySelector("[name='width[]']").value;
        const height = document.querySelector("[name='height[]']").value;
        const weight = document.querySelector("[name='weight[]']").value;
        const cargoFilled = category && length && width && height && weight;
        indicators.cargo.classList.toggle("complete", cargoFilled);
        indicators.cargo.classList.toggle("active", currentStep === 2);
    }

    nextBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                localStorage.setItem("formStep", currentStep);
                showStep(currentStep);
            }
        });
    });

    backBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                localStorage.setItem("formStep", currentStep);
                showStep(currentStep);
            }
        });
    });
 
    document.querySelectorAll("input, select").forEach(input => {
        input.addEventListener("input", updateProgress);
    });
 
    showStep(currentStep);
</script>

<script>
    const steps = document.querySelectorAll(".form-step");
    const nextBtns = document.querySelectorAll(".btn-next");
    const backBtns = document.querySelectorAll(".btn-back");
    let currentStep = 0;

    const stepRoute = document.getElementById("stepRoute");
    const stepSender = document.getElementById("stepSender");
    const stepCargo = document.getElementById("stepCargo");
    const lines = document.querySelectorAll(".progress-line");

    function updateProgressSteps() {
        // Check completion
        const origin = document.getElementById("origin").value;
        const destination = document.getElementById("destination").value;
        const routeFilled = origin && destination;

        const street = document.querySelector("[name='street']").value;
        const brgy = document.querySelector("[name='brgy']").value;
        const city = document.querySelector("[name='city']").value;
        const province = document.querySelector("[name='province']").value;
        const zipcode = document.querySelector("[name='zipcode']").value;
        const region = document.querySelector("[name='region']").value;
        const senderFilled = street && brgy && city && province && zipcode && region;

        const category = document.querySelector("[name='category[]']").value;
        const length = document.querySelector("[name='length[]']").value;
        const width = document.querySelector("[name='width[]']").value;
        const height = document.querySelector("[name='height[]']").value;
        const weight = document.querySelector("[name='weight[]']").value;
        const cargoFilled = category && length && width && height && weight;

        // Reset all
        stepRoute.classList.remove("active", "complete");
        stepSender.classList.remove("active", "complete");
        stepCargo.classList.remove("active", "complete");
        lines.forEach(line => line.classList.remove("active"));

        // Set progress state
        if (routeFilled) stepRoute.classList.add("complete");
        else stepRoute.classList.add("active");

        if (senderFilled) {
            stepSender.classList.add("complete");
            lines[0].classList.add("active");
        } else if (routeFilled) {
            stepSender.classList.add("active");
        }

        if (cargoFilled) {
            stepCargo.classList.add("complete");
            lines[1].classList.add("active");
        } else if (senderFilled) {
            stepCargo.classList.add("active");
        }
    }

    // Bind navigation
    nextBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    backBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Watch input changes
    document.querySelectorAll("input, select").forEach(input => {
        input.addEventListener("input", updateProgressSteps);
    });

    // Initial trigger
    updateProgressSteps();
</script>



<script>
    $(document).ready(function () {
        let maxWeight = 0;

        $.ajax({
            url: "/get-weight-limit",
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log("Fetched Weight Limit:", response);  
                if (response.weight) {
                    maxWeight = parseFloat(response.weight);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });

        $("input[name='weight[]']").on("input", function () {
            let inputWeight = parseFloat($(this).val());

            if (inputWeight > maxWeight) {
                showErrorAlert("We're Sorry, but the maximum allowed weight is " + maxWeight + " kg.");
                $(this).val(maxWeight);
            }
        }); 

        function showErrorAlert(message) {
            let errorAlert = $("#error-alert");
            errorAlert.html("<strong></strong> " + message);
            errorAlert.show().removeClass("hide");

            setTimeout(() => {
                errorAlert.addClass("hide");
                setTimeout(() => {
                    errorAlert.hide();
                }, 500);
            }, 3000);
        }
    });
</script>

<div id="error-alert" class="error_alert" style="display: none;">
    <strong>Error:</strong> The entered weight exceeds the allowed limit!
</div>
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

@endsection
<script>
    let maxWeight = 0;
 
    document.addEventListener("DOMContentLoaded", function () {
        fetch("/get-weight-limit")
            .then(response => response.json())
            .then(data => {
                console.log("Fetched Weight Limit:", data);  
                if (data.weight) {
                    maxWeight = parseFloat(data.weight);
                }
            })
            .catch(error => console.error("Fetch Error:", error));
    });

    function addCategory() {
        const categoryContainer = document.getElementById('category-container');
        const newCategory = `
            <div class="form-groups">
                <div class="category">
                    <label>Category</label>
                    <select name="category[]" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                        @endforeach
                    </select>   
                </div>
                <div class="form-columns">
                    <div class="dimension">
                        <label>Length (m)</label>
                        <input type="number" name="length[]" placeholder="Enter length" required>
                    </div>
                    <div class="dimension">
                        <label>Width (m)</label>
                        <input type="number" name="width[]" placeholder="Enter width" required>
                    </div>
                    <div class="dimension">
                        <label>Height (m)</label>
                        <input type="number" name="height[]" placeholder="Enter height" required>
                    </div>
                    <div class="dimension">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight[]" placeholder="Enter weight" oninput="validateWeight(this)" required>
                    </div>
                </div>
                <button class="remove-category-btn" type="button" onclick="removeCategory(this)">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>
            </div>
        `;
        categoryContainer.insertAdjacentHTML('beforeend', newCategory);
        updateCategoryCount();
    }

    function validateWeight(input) {
        let inputWeight = parseFloat(input.value);

        if (inputWeight > maxWeight) {
            showErrorAlert("We're sorry, but the maximum allowed weight is " + maxWeight + " kg.");
            input.value = maxWeight;  
        }
    }

    function removeCategory(button) {
        button.parentElement.remove();
        updateCategoryCount();
    }

    function updateCategoryCount() {
        const count = document.querySelectorAll('#category-container .form-groups').length;
        document.getElementById('category-count').textContent = count;
    }

    function showErrorAlert(message) {
        let errorAlert = document.getElementById("error-alert");
        errorAlert.innerHTML = "<strong></strong> " + message;
        errorAlert.style.display = "block";
        errorAlert.classList.remove("hide");

        setTimeout(() => {
            errorAlert.classList.add("hide");
            setTimeout(() => {
                errorAlert.style.display = "none";
            }, 500);
        }, 3000);
    }
</script>


</body>
</html>
