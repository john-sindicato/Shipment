<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        scroll-behavior: smooth; 
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center; 
        background: #fff;
        backdrop-filter: blur(20px); 
        border-bottom: 2px solid #ddd;
        padding: 15px 30px;
        padding-left: 110px;
        padding-right: 100px;
        position: fixed;
        top: 0;  
        right: 0;
        left: 0;
        z-index: 1000;
        transition: transform 0.3s ease;   
    }

    @media (max-width: 1024px) { 
        .navbar {
            padding-left: 50px;
            padding-right: 50px;
        }
    }

    @media (max-width: 768px) { 
        .navbar {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media (max-width: 480px) { 
        .navbar { 
            padding: 10px 15px;
        }
    }

    .navbar div {
        display: flex;
        align-items: center;
    }

    .navbar strong {
        color: #000;
        font-size: 40px;
        margin-right: 20px;
        font-family: "Times New Roman", Times, serif;
        cursor: pointer;
    }

    .navbar img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .navbar a {
        color: #000;
        text-decoration: none;
        margin: 0 15px;
        font-size: 1em;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .navbar a:hover {
        color: #00bcd4;
        transform: translateY(-3px);
    }

    .navbar a:active {
        color: #0097a7;
        transform: translateY(1px);
    }

    .navbar .menu {
        display: flex;
    }

    .navbar .menu a {
        display: block;
    }

    html, body {
        overflow-x: hidden;
        width: 100%;
        position: relative;
    }

    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background-color: #4A90E2;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background-color: #3a7bc8;
        transform: translateY(-3px);
    }

    @media (max-width: 768px) {
        .back-to-top {
            width: 40px;
            height: 40px;
            bottom: 20px;
            right: 20px;
        }
    }
</style>

</head>
<body>
    
    <style> 
        .about-us,
        .about,
        .services,
        .ports-section,
        .branches-section { 
            padding-left: 110px !important;
            padding-right: 110px !important;
        }

        @media (max-width: 1024px) {
            .about-us,
            .about,
            .services,
            .ports-section,
            .branches-section { 
                padding-left: 50px !important;
                padding-right: 50px !important;
            }
        }

        @media (max-width: 768px) {
            .about-us,
            .about,
            .services,
            .ports-section,
            .branches-section { 
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }

        @media (max-width: 480px) {
            .about-us,
            .about,
            .services,
            .ports-section,
            .branches-section { 
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
        }
    </style>
    
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

    <div class="navbar">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="Navi Cargo Logo">
            <strong onclick="window.location.href='{{ route('index') }}'">Navi Cargo</strong>
        </div>
        <div class="hamburger" id="hamburger-btn">
            <div></div>
            <div></div>
            <div></div>
        </div> 
        <div class="menu" id="sidebar-menu">
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#services">Services</a>
            <a href="#routes">Routes</a>
            <a href="#branches">Branches</a>
            <a href="#contact">Contact Us</a>
        </div>
    </div>
    <div class="menu-overlay" id="menu-overlay"></div>
     
  
    <style> 
        @media (max-width: 768px) {
            .navbar > div:first-child {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .navbar img {
                width: 32px;
                height: 32px;
                margin-right: 6px;
            }
            .navbar strong {
                font-size: 30px;
                margin-right: 0;  
                white-space: nowrap;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: #fff;
            }
            .navbar .menu {
                position: fixed;
                top: 0;
                right: -240px;  
                left: auto;      
                height: 100vh;
                width: 220px;
                background: #fff;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                padding-top: 70px;
                box-shadow: -2px 0 16px rgba(99,102,241,0.07);  
                transition: right 0.35s cubic-bezier(.77,0,.18,1);
                z-index: 1100;
                display: flex !important;
            }
            .navbar .menu.open {
                right: 0;        
            }
            .navbar .menu a {
                margin: 10px 0 10px 24px;
                font-size: 1.1em;
                width: 100%;
                text-align: left;
            }
            .navbar .hamburger {
                display: flex !important;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 44px;
                height: 44px;
                background: transparent;
                border: none;
                z-index: 1101;
                cursor: pointer;
            }
            .navbar .hamburger div {
                width: 30px;
                height: 4px;
                background-color: #000;
                margin: 4px 0;
                border-radius: 2px;
                transition: 0.4s;
                position: relative;
            } 
            .navbar .hamburger.active div:nth-child(1) {
                transform: translateY(10px) rotate(45deg);
            }
            .navbar .hamburger.active div:nth-child(2) {
                opacity: 0;
            }
            .navbar .hamburger.active div:nth-child(3) {
                transform: translateY(-10px) rotate(-45deg);
            } 
            .navbar .hamburger div {
                margin: 3px 0;
            }
        }
    </style>
    
    <script>
        (function() {
            const hamburger = document.getElementById('hamburger-btn');
            const sidebarMenu = document.getElementById('sidebar-menu');
            const overlay = document.getElementById('menu-overlay');
        
            function openSidebar() {
                sidebarMenu.classList.add('open');
                hamburger.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            function closeSidebar() {
                sidebarMenu.classList.remove('open');
                hamburger.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
            function toggleSidebar() {
                if (sidebarMenu.classList.contains('open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }
        
            hamburger.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });
            overlay.addEventListener('click', closeSidebar);
         
            sidebarMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) closeSidebar();
                });
            });
         
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSidebar();
            });
         
            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) closeSidebar();
            });
         
            document.addEventListener('click', function(e) {
                if (
                    sidebarMenu.classList.contains('open') &&
                    !sidebarMenu.contains(e.target) &&
                    !hamburger.contains(e.target)
                ) {
                    closeSidebar();
                }
            });
        })();
    </script>
    

        <script> 
            let lastScrollTop = 0;   
            const navbar = document.querySelector('.navbar'); 

            window.addEventListener('scroll', function() {
                let currentScroll = window.pageYOffset || document.documentElement.scrollTop;  

                if (currentScroll > lastScrollTop) { 
                    navbar.style.transform = 'translateY(-100%)';  
                } else { 
                    navbar.style.transform = 'translateY(0)';  
                }

                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;  
            });
        </script>

        <style>
            .hero { 
                background: #fff; ;
                background-size: 50% 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;  
                padding-top: 77px;
            }

            @media (max-width: 1024px) {
                .hero {
                    padding-top: 80px;
                }
            }
            @media (max-width: 768px) {
                .hero {
                    padding-top: 70px;
                }
            }
            @media (max-width: 480px) {
                .hero {
                    padding-top: 60px;
                }
            }

            .hero h1 {
                font-size: 45px;
                font-weight: 500; 
                margin-bottom: 20px;
                animation: fadeInUp 1.5s ease-out;
            }

            .hero p {
                font-size: 20px; 
                max-width: 650px; 
                line-height: 1;
                animation: fadeInUp 1.8s ease-out;
            }

            .cta-btn {
                display: inline-block;
                padding: 10px 30px;
                background-color: #fff;
                color: #000;
                font-size: 18px; 
                border-radius: 5px;
                text-decoration: none;
                box-shadow: 0 6px 12px rgba(0, 188, 212, 0.3);
                transition: all 0.3s ease;
                animation: fadeInUp 2s ease-out;
            }

            .cta-btn1 {
                display: inline-block;
                padding: 10px 30px;
                background-color: transparent;
                color: #fff;
                margin-left: 5px;
                border: 1px solid #fff;
                font-size: 18px; 
                border-radius: 8px;
                text-decoration: none;
                box-shadow: 0 6px 12px rgba(0, 188, 212, 0.3);
                transition: all 0.3s ease;
                animation: fadeInUp 2s ease-out;
            }

            .cta-btn:hover {
                background-color: rgba(255, 255, 255, 0.7);
            }

            .cta-btn1:hover {
                background-color: rgba(255, 255, 255, 0.7); 
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

            .pic {
                background-image: url("{{ asset('img/bluebackground.jpg') }}");  
                background-size: cover;
                background-position: center;
                width: 100%;
                height: 55vh;   
                display: flex;
                justify-content: flex-start;  
                align-items: center;
                color: white;  
            }

            .content {
                text-align: left;  
                margin-left: 100px;     
            }

            .content h1{
                color: #fff;
            }

            .content p {
                color: #fff;
            }
        
            @media (max-width: 1024px) {
                .hero {
                    flex-direction: column;  
                    text-align: center;  
                }

                .content {
                    margin-left: 0;   
                    text-align: center;  
                }

                .cta-btn, .cta-btn1 {
                    width: 20%;  
                    margin: 10px 0; 
                }

                .pic {
                    height: 40vh;  
                }
            }

            @media (max-width: 768px) {
                .pic {
                    height: 45vh;   
                }
            }

            @media (max-width: 480px) {
                .hero h1 {
                    font-size: 28px;  
                }

                .hero p {
                    font-size: 16px; 
                }

                .pic {
                    height: 40vh;  
                }

                .cta-btn, .cta-btn1 {
                    font-size: 16px;  
                    padding: 12px 25px;  
                }
            }
        </style>

        <div class="hero" id="home">
            <div class="pic">
                <div class="content">
                    <h1>Efficient Shipping Solutions</h1>
                    <p>Our platform ensures fast and secure deliveries with the best rates to meet your needs.</p>
                    <a href="{{ route('login') }}" class="cta-btn">Login</a>
                    <a href="{{ route('sign_up') }}" class="cta-btn1">Sign Up</a>
                </div>        
            </div>
        </div>

        <style>
            .about-us {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                background-color: #f4f4f4;
                padding: 10px 20px;
                padding-top: 70px; 
                align-items: center;  
            }

            .about-us-description {
                font-size: 18px;
                line-height: 1.8;   
                margin-bottom: 20px;
                text-align: justify;   
                padding-right: 15px;   
            }

            .about-us-content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                width: 100%;
            }

            .abouts {
                flex: 1;
                margin-right: 30px;
                margin-bottom: 30px;   
            }

            .abouts h2 {
                font-size: 26px;   
                margin-bottom: 15px;  
                font-weight: 600;   
                color: #000;   
                text-transform: uppercase;
            }

            .abouts p {
                font-size: 16px;
                line-height: 1.8;  
                text-align: justify;  
                color: #000;   
            }
            
            @media (max-width: 768px) {
                .abouts {
                    margin-right: 0;
                    margin-bottom: 20px;  
                }

                .about-us-description {
                    padding-right: 0;  
                }
            }

            .about-image {
                flex: 0.9; 
                height: 100%; 
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .about-image img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }
        
            @media (max-width: 1024px) {
                .about-us {
                    flex-direction: column;
                    padding: 20px;
                }

                .about-image {
                    height: 300px;
                    margin-top: 20px;
                }

                .abouts {
                    margin-right: 0;
                    margin-bottom: 20px;
                }
            }
        </style>
        <section class="about-us" id="about">
            <div class="abouts">
                <h2>About Us</h2>
                <p class="about-us-description">
                    Navi Cargo is a local shipping company dedicated to providing reliable, fast, and affordable shipping services. We focus on delivering your cargo safely and on time, offering personalized services for every customer. Our mission is to revolutionize local logistics with innovative solutions and unmatched customer service. At Navi Cargo, we believe in putting the customer first. Our team is committed to providing transparent, on-time services tailored to your specific needs. From initial booking to final delivery, we ensure each step of the shipment process is executed with care, efficiency, and professionalism. We take the time to understand your requirements and provide customized solutions to ensure a smooth and hassle-free shipping experience. Our mission is to offer a seamless, efficient, and dependable shipping experience. We strive to be the most customer-centric local shipping company, continuously improving our services to meet the growing needs of our customers. We aim to be the leading local shipping provider, trusted by customers for our innovation, reliability, and commitment to excellence in every delivery.
                </p>    
            </div>

            <div class="about-image">
                <img src="{{ asset('img/about.webp') }}" alt="About Us Image"> 
            </div>
        </section>


        <style>
            .about {
                padding: 40px 20px;
                background-color: #f8f8f8;
            }

            .about-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 30px;
            }

            .feature.left img {
                width: 100%;
                max-width: 1200px;  
                height: auto; 
            }

            .feature.right {
                flex: 1;
                text-align: justify;
                padding: 20px;
            }

            .feature.right h2 {
                font-size: 30px; 
                font-weight: 600;
                margin-bottom: -10px;
                color: #000;
            }

            .about-description {
                font-size: 14px; 
                line-height: 1.6;
                margin-bottom: 30px;
                color: #000;
            }

            .about-features {
                margin-top: 20px;
            }

            .feature-text {
                margin-bottom: 20px;
            }

            .feature-text h3 {
                font-size: 18px;  
                font-weight: 600;
                color: #000;
                text-transform: uppercase;
                margin-bottom: -10px; 
            }

            .feature-text p {
                font-size: 14px; 
                line-height: 1.7;
                color: #000;
            }

            @media (max-width: 768px) {
                .about {
                    padding: 10px;
                    left: 0;
                }

                .about-content {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .feature.left img {
                    display: none; 
                }

                .feature.right {
                    width: 100%;
                }

                .feature-text p {
                    font-size: 12px; 
                    max-width: 350px;
                }

                .feature.right h2 {
                    font-size: 26px;  
                }

                .about-description {
                    font-size: 12px;  
                    max-width: 350px;
                }
            }
        </style>
        <section class="about">
            <div class="about-content">
                <div class="feature left">
                    <img src="{{ asset('img/about.jpg') }}" alt="Navi Cargo Image">
                </div>
                <div class="feature right">
                    <h2>Why Choose Navi Cargo?</h2>
                    <p class="about-description">At Navi Cargo, we provide exceptional local shipping services, ensuring that your cargo is delivered safely and on time. Here’s why we are the best choice for all your shipping needs:</p>
                    <div class="about-features">
                        <div class="feature-text">
                            <h3>Reliability</h3>
                            <p>Reliability is the core of our service. At Navi Cargo, we prioritize timely deliveries, ensuring your goods are transported with the utmost care. Our team is committed to maintaining the highest standards of professionalism, taking every precaution necessary to guarantee safe and secure shipping.</p>
                        </div>
                        <div class="feature-text">
                            <h3>Affordability</h3>
                            <p>We offer competitive and transparent pricing for all routes. We believe in making shipping accessible and fair for everyone. Whether you’re shipping a small package or large cargo, we ensure you receive the best value without compromising on quality or service.</p>
                        </div>
                        <div class="feature-text">
                            <h3>24/7 Support</h3>
                            <p>Our support team is here around the clock to assist you with any questions or updates on your shipments. We believe that excellent customer service is key to building trust and long-term relationships with our clients.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    

        <style>
            .services {
                padding: 70px 20px;
                background-color: #eaf2f8;
                text-align: center; 
            }

            .services h1 {
                font-size: 36px;
                font-weight: 700;
                color: #000;
                margin-bottom: 30px;
                text-align: center;
            }

            .services-description {
                font-size: 16px;
                line-height: 1.8;
                color: #000;
                max-width: 90%;
                margin: 0 auto 40px auto;
                padding: 0 20px;
            }

            .service-cards {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 30px;
                width: 100%; 
            }

            .service-card {
                background-color: #fff; 
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                flex: 1 1 30%;
                padding: 25px;
                margin: 10px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                width: 30%;
            }

            .service-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .service-card h3 {
                font-size: 24px;
                font-weight: 600;
                color: #000;
                margin-bottom: 20px;
            }

            .service-card p {
                font-size: 16px;
                line-height: 1.8;
                color: #000;
                text-align: justify;
            }
            
            @media screen and (max-width: 768px) {
                .services {
                    padding: 40px 30px;
                }

                .service-cards {
                    flex-direction: column;   
                    align-items: center;
                }

                .service-card {
                    width: 90%;  
                    margin-bottom: 20px; 
                }
            }

            @media screen and (max-width: 480px) {
                .services {
                    padding: 30px 30px;
                }

                .service-card {
                    width: 80%;   
                }
            }
        </style>
        <section class="services" id="services">
            <h1>What We Offer</h1>
            <p class="services-description">At Navi Cargo, we offer a wide range of tailored, dependable, and efficient shipping services designed to meet all your logistics needs. Whether you are shipping small packages, large cargo, or time-sensitive deliveries, our team is here to ensure a seamless, safe, and reliable experience from start to finish. We pride ourselves on providing the most comprehensive and flexible shipping solutions, all backed by a commitment to customer satisfaction and excellence.</p>
            <div class="service-cards">
                <div class="service-card">
                    <h3>On-Time Delivery</h3>
                    <p>One of the core values at Navi Cargo is our commitment to on-time delivery. We understand that in the fast-paced world of logistics, timing is crucial. That’s why we have implemented a system of strict monitoring, optimized routes, and well-trained personnel to ensure that every shipment arrives on schedule. Whether it’s a local shipment or a more complex, multi-step journey, we guarantee that your items will arrive when promised, without fail. In the event of any unexpected delays, our customers are kept informed with real-time tracking updates, giving you the peace of mind that your shipment is on its way and will reach its destination within the agreed timeframe.</p>
                </div>
                <div class="service-card">
                    <h3>Safe and Secure Transport</h3>
                    <p>At Navi Cargo, we know that the safety of your cargo is your top priority. Our services are built with safety at the forefront of our operations. From the moment your items are picked up to the moment they are delivered, we use only the highest quality equipment, well-maintained vehicles, and secure packaging to protect your goods during transport. Our team is trained to handle sensitive or fragile items with care, ensuring they are safely delivered, no matter the destination. With multiple layers of safety protocols, including GPS tracking, insurance options, and secure handling, we guarantee that your goods will reach their destination securely and without damage. We also offer specialized services for high-value or fragile shipments, providing extra protection for peace of mind.</p>
                </div>
                <div class="service-card">
                    <h3>Transparent Pricing</h3>
                    <p>We believe in providing clear, transparent, and competitive pricing for all our services. At Navi Cargo, there are no hidden fees or unexpected costs — what you see is what you get. Our pricing structure is straightforward, and we offer customizable solutions to match the size and scope of your shipment. Whether you're shipping a small parcel or a large bulk order, we ensure that the pricing is clear and provides excellent value. Additionally, we offer real-time price estimates and customizable service packages, allowing you to choose the best option based on your budget and shipping requirements. Our goal is to help you save money while delivering a high-quality service, and we’re always transparent with our pricing, so you can make an informed decision based on your needs.</p>
                </div>
            </div>
        </section>


        <section class="ports-section" id="routes">
            <h2>Routes and Shipping Rates</h2>
            <p>Explore our extensive network of local ports and choose the best one for your shipment. You can also view the shipping rates for each origin-destination pair below.</p>
            <h3>Once you're logged in, you can switch the routes upon clicking the 'Request a Quote' button.</h3>

            <div class="rates-container-wrapper">
                <div class="rates-container">
                    @foreach($rates as $rate)
                        <div class="rate-item">
                            <div class="rate-header">{{ $rate->origin }} to {{ $rate->destination }}</div>

                            <div class="rate-price-container">
                                @if($rate->status == 'close')
                                    <div class="rate-details">
                                        <p>Unfortunately, this route is currently unavailable. Please explore other options or contact us for assistance.</p>
                                    </div>
                                    <p class="unavailable-message">This route is currently unavailable.</p>
                                @else
                                    <div class="rate-details">
                                        <p>{{ sprintf("Shipping from %s to %s is fast and affordable, making your logistics easier!", $rate->origin, $rate->destination) }}</p>
                                    </div>
                                    <div class="rate-price">PHP {{ $rate->price }} per kg</div>
                                    <a href="{{ route('login') }}" class="request-quote-btn">Request a Quote</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
        
                <div class="arrows-container">
                    <span class="arrow left-arrow"><i class='bx bx-left-arrow-alt'></i></span>
                    <span class="arrow right-arrow"><i class='bx bx-right-arrow-alt'></i></span>
                </div>
            </div>
        </section>

        <style> 
            .ports-section {
                padding: 70px 20px;
                background-color: #ffffff;
                font-family: "Inter", "Segoe UI", Roboto, sans-serif;
                padding-bottom: 0px;
            }

            .ports-section h2 {
                font-size: 2rem;
                color: #000;
                margin-bottom: 1rem;
                text-align: center;
            }

            .ports-section h3 {
                font-size: 1.1rem;
                color: #000;
                margin-bottom: 2rem;
                text-align: center;
                font-weight: 500;
            }

            .ports-section p {
                color: #000;
                line-height: 1.6;
                margin-bottom: 1.5rem;
                text-align: center;
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .rates-container-wrapper {
                position: relative;
                width: 100%; 
                margin: 0 auto;
                overflow: hidden;
                padding-bottom: 90px;  
            }

            .rates-container {
                display: flex;
                gap: 1.5rem;
                padding: 1rem 0.5rem;
                overflow-x: auto;
                scroll-behavior: smooth;
                scrollbar-width: none;  
                -ms-overflow-style: none;  
            }

            .rates-container::-webkit-scrollbar {
                display: none;  
            }
            
            .rate-item {
                flex: 0 0 300px;
                background-color: white; 
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                border: 1px solid #ddd;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .rate-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            }

            .rate-header {
                background: linear-gradient(135deg, #5b84c4, #4a6fa5);
                color: #fff;
                padding: 1rem;
                font-weight: 600;
                font-size: 1.1rem;
                text-align: center;
            }

            .rate-price-container {
                padding: 1.5rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .rate-details p {
                font-size: 0.9rem;
                color: #000;
                margin-bottom: 1rem;
                text-align: left;
            }

            .rate-price {
                font-size: 1.5rem;
                font-weight: 700;
                color: #000;
                margin-bottom: 1rem;
            }

            .request-quote-btn {
                display: inline-block;
                background-color: #4a90e2;
                color: #fff;
                padding: 0.75rem 1.5rem;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 600;
                text-align: center;
                transition: background-color 0.2s ease;
            }

            .request-quote-btn:hover {
                background-color: #3a7bc8;
            }

            .rate-price-container .unavailable-message {
                color: #e74c3c;
                margin-top: 0.5rem;
                font-weight: 600;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0.5rem;
                background-color: rgba(231, 76, 60, 0.1);
                border-radius: 8px;
            }

            .arrows-container {
                width: 100%;  
                display: flex;
                justify-content: center;  
                position: absolute;
                z-index: 10;
            } 
            
            @media (max-width: 768px) { 
                .ports-section h2 {
                    font-size: 1.75rem;
                }

                .ports-section h3 {
                    font-size: 1rem;
                    padding: 10px;
                }

                .ports-section p {
                    padding-left: 20px;
                    padding-right: 20px;
                }

                .rate-item {
                    flex: 0 0 280px;
                } 
            }

            @media (max-width: 480px) { 
                .ports-section h2 {
                    font-size: 1.5rem;
                }

                .ports-section h3 {
                    font-size: 0.9rem;
                }

                .rate-item {
                    flex: 0 0 260px;
                } 
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ratesContainer = document.querySelector('.rates-container');
                const leftArrow = document.querySelector('.left-arrow');
                const rightArrow = document.querySelector('.right-arrow');

                function checkArrowsVisibility() {
                    const isOverflowing = ratesContainer.scrollWidth > ratesContainer.clientWidth;
                    leftArrow.style.display = isOverflowing ? 'block' : 'none';
                    rightArrow.style.display = isOverflowing ? 'block' : 'none';
                }

                function scrollNextPage(direction) {
                    const scrollAmount = ratesContainer.clientWidth;
                    ratesContainer.scrollBy({
                        left: direction === 'right' ? scrollAmount : -scrollAmount,
                        behavior: 'smooth'  
                    });
                }

                rightArrow.addEventListener('click', () => scrollNextPage('right'));
                leftArrow.addEventListener('click', () => scrollNextPage('left'));

                checkArrowsVisibility();
                window.addEventListener('resize', checkArrowsVisibility);
            });
        </script>

    

        <section class="branches-section" id="branches">
            <h2>Our Branches</h2>
            <p>Find our branches across various provinces. Reach out to us directly for any inquiries or assistance with your shipments.</p>
            <div class="branches-container-wrapper">
                <div class="branches-container">
                    @forelse ($branches as $branch)
                        <div class='branch-item'>
                            <div class='branch-header'>{{ $branch->province }}</div>
                            <div class="branch-details">
                                <div class="branch-detail">
                                    <i class="bx bxs-map"></i>
                                    <div class="detail-content">
                                        <span class="detail-title">Address:</span>
                                        <span class="detail-info">{{ $branch->address }}</span>
                                    </div>
                                </div>
                                <div class="branch-detail">
                                    <i class="bx bxs-user"></i>
                                    <div class="detail-content">
                                        <span class="detail-title">Contact Person:</span>
                                        <span class="detail-info">{{ $branch->contact_person }}</span>
                                    </div>
                                </div>
                                <div class="branch-detail">
                                    <i class="bx bxs-phone"></i>
                                    <div class="detail-content">
                                        <span class="detail-title">Phone:</span>
                                        <span class="detail-info">{{ $branch->phone }}</span>
                                    </div>
                                </div>
                                <div class="branch-detail">
                                    <i class="bx bxs-envelope"></i>
                                    <div class="detail-content">
                                        <span class="detail-title">Email:</span>
                                        <span class="detail-info">{{ $branch->email }}</span>
                                    </div>
                                </div>
                                @if($branch->status == 'close')
                                    <div class="branch-status">
                                        <span>Temporarily Closed</span>
                                    </div>
                                @endif
                            </div>                    
                        </div>
                    @empty
                        <p>No branches available at this time.</p>
                    @endforelse
                </div>
        
                <div class="arrow-container-branch">
                    <span id="left-branch-arrow" class="arrow left-arrow"><i class='bx bx-left-arrow-alt'></i></span>
                    <span id="right-branch-arrow" class="arrow right-arrow"><i class='bx bx-right-arrow-alt'></i></span>
                </div>
            </div>
        </section>

        <style>
            .branches-section {
                text-align: center; 
                padding: 70px 20px;
                padding-bottom: 70px; 
                background: #fff;
                border-top: 1px solid #ddd; 
            }

            .branches-section h2 {
                font-size: 2em;
                color: #000;
            }

            .branches-section p {
                color: #000;
            }

            .branches-container-wrapper {
                position: relative;
                width: 100%;
                display: flex;
                align-items: center; 
            }

            .branches-container {
                width: 100%;
                display: flex;
                gap: 1.5rem;
                padding: 1rem 0.5rem;
                overflow-x: auto;
                scroll-behavior: smooth;
                scrollbar-width: none;  
                -ms-overflow-style: none;  
                padding-bottom: 50px;
            }

            .branches-container::-webkit-scrollbar {
                display: none;  
            }
            
            .branch-item {
                flex: 0 0 300px;
                background-color: white; 
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                border: 1px solid #ddd;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .branch-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            }

            .branch-header {
                background-color: #3a506b;
                color: white;
                padding: 1rem;
                font-weight: 600;
                font-size: 1.1rem;
                text-align: center;
            }

            .branch-details {
                display: flex;
                flex-direction: column;
                gap: 20px;
                padding: 20px; 
            }

            .branch-detail {
                display: flex;
                align-items: flex-start;
                gap: 15px;
            }

            .branch-detail i {
                font-size: 1.5rem;
                color: #007bff;
            }

            .detail-content {
                display: flex;
                text-align: left;
                flex-direction: column;
                justify-content: flex-start;
            }

            .detail-title {
                font-size: 1rem;
                font-weight: 600;
                color: #444;
            }

            .detail-info {
                font-size: 0.95rem;
                color: #000;
            }

            .branch-status {
                background-color: rgba(231, 76, 60, 0.1);
                color: #e74c3c;
                padding: 12px;
                font-weight: bold;
                border-radius: 5px;
                text-align: center;
                margin-top: 15px;
            }

            .branch-details p[style*="color: #e74c3c"] {
                margin-top: 0.5rem;
                font-weight: 600;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0.5rem;
                background-color: rgba(231, 76, 60, 0.1);
                border-radius: 4px;
            }

            .arrow-container-branch {
                width: 100%;  
                display: flex;
                justify-content: center;  
                position: absolute;
                bottom: -40px; 
                z-index: 10;
            }

            .arrow {
                font-size: 2rem;
                color: #3a506b;  
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 5px 12px;
                border-radius: 5px;
                background-color: transparent;  
                border: 2px solid #3a506b; 
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .arrow:hover {
                background-color: #f0f8ff; 
                transform: scale(1.1); 
            }

            .arrow i {
                transition: transform 0.3s ease;
            }
            
            .left-arrow {
                margin-right: 10px;
            }

            .right-arrow {
                margin-left: 10px;
            }
            
            @media (max-width: 768px) { 
                .branch-item {
                    flex: 0 0 280px;
                } 
            }

            @media (max-width: 480px) { 
                .branches-container-wrapper {
                    margin: 1.5rem 0;
                }
                
                .branch-item {
                    flex: 0 0 260px;
                }
                
                .branch-header {
                    font-size: 1rem;
                    padding: 0.75rem;
                }
                
                .branch-details {
                    padding: 1.25rem;
                    gap: 0.5rem;
                }
                
                .branch-details p {
                    font-size: 0.9rem;
                } 
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const branchesContainer = document.querySelector('.branches-container');
                const leftArrow = document.getElementById('left-branch-arrow');
                const rightArrow = document.getElementById('right-branch-arrow');

                function checkArrowsVisibility() {
                    const isOverflowing = branchesContainer.scrollWidth > branchesContainer.clientWidth;

                    leftArrow.style.display = isOverflowing ? 'block' : 'none';
                    rightArrow.style.display = isOverflowing ? 'block' : 'none';
                }
        
                branchesContainer.style.scrollBehavior = 'smooth';
        
                rightArrow.addEventListener('click', function () {
                    const scrollAmount = branchesContainer.clientWidth;
                    branchesContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                });

                leftArrow.addEventListener('click', function () {
                    const scrollAmount = branchesContainer.clientWidth;
                    branchesContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                });

                checkArrowsVisibility();
                window.addEventListener('resize', checkArrowsVisibility);
            });
        </script>

    

        <section class="contact-us"  id="contact">
            <div class="contact-header">
                <h2>Contact Navi Cargo</h2>
                <p>If you have any questions or would like to get more information about our services, please reach out to us using the form below.</p>
            </div>

            <div class="contact-details">
                <h3>Our Contact Details</h3>
                @if($company)
                <div class="con">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="contact-info">
                            <strong>Address:</strong>
                            <p>{{ $company->address }}</p>
                        </div>
                    </div>
            
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <div class="contact-info">
                            <strong>Phone:</strong>
                            <p>{{ $company->phone }}</p>
                        </div>
                    </div>
            
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div class="contact-info">
                            <strong>Email:</strong>
                            <p>{{ $company->email }}</p>
                        </div>
                    </div>
                </div>
                @else
                <p>No contact details available.</p>
                @endif
            </div>
            

            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="fname" name="fname" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lname" name="lname" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" id="phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </section>
        <style>
            .contact-us {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between; 
                padding: 20px 110px; 
                background: #fff;
                border-top: 1px solid #ddd;  
            }

            .contact-header {
                width: 100%;
                text-align: center;
            }

            .contact-header h2 {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
            }

            .contact-header p {
                font-size: 1rem;
                color: #555;
            }

            .contact-details {
                flex: 1;
                min-width: 250px;
                padding: 3.5rem;
            }

            .contact-details h3 {
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .contact-item {
                display: flex;
                align-items: center;  
                margin-bottom: 20px;
            }

            .contact-item i {
                font-size: 1.2rem;
                color: white;
                background: #4A90E2;  
                padding: 10px;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .contact-info {
                display: flex;
                flex-direction: column;  
                font-size: 1rem;
                margin-left: 1rem; 
            }

            .contact-info strong {
                color: #00243d;  
                font-weight: bold;
            }

            .contact-info p {
                margin: 2px 0 0;  
                font-size: 0.95rem;
                color: #000;
                max-width: 400px;
            }
        
            .contact-form {
                flex: 1;
                min-width: 250px;
                padding: 1.5rem;
                border: 1px solid #90a4ae; 
                border-radius: 8px;
                background-color: #eaf2f8; 
                box-sizing: border-box;
            }

            .contact-form h3 {
                font-size: 1.8rem;
                margin-bottom: 1rem;
                color: #000; 
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group label {
                font-size: 1rem;
                display: block;
                margin-bottom: 0.5rem;
                color: #000;  
            }

            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 0.75rem;
                font-size: 1rem;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .form-group textarea {
                resize: vertical;
            }

            .form-group input:focus,
            .form-group textarea:focus {
                background-color: white;
            }
            input:-webkit-autofill,
            textarea:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px white inset !important;
                -webkit-text-fill-color: #000 !important;
                transition: background-color 5000s ease-in-out 0s;
            }
            .form-group input:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px white inset !important;
            }

            .submit-btn {
                background-color: #00243d;
                color: #fff;
                padding: 0.75rem 2rem;
                font-size: 1rem;
                border: 1px solid #d1d9e6;
                border-radius: 4px;
                cursor: pointer;
                transition: background 0.3s ease, box-shadow 0.3s ease;
            }

            .submit-btn:hover {
                background-color: #003a5c;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 1024px) {
                .contact-us {
                    flex-direction: column;
                }

                .contact-info p {
                    max-width: 200px;
                }

                .contact-details,
                .contact-form {
                    margin-left: 0;
                    margin-right: 0;
                }

                .contact-header h2 {
                    font-size: 2rem;
                }

                .contact-details h3, .contact-form h3 {
                    font-size: 1.6rem;
                }

                .form-group input, .form-group textarea {
                    font-size: 0.95rem;
                }

                .submit-btn {
                    padding: 0.75rem 1.5rem;
                }
            }

            @media (max-width: 768px) {
                .contact-us {
                    padding: 30px 10px;
                }

                .contact-info p {
                    max-width: 200px;
                }

                .contact-header h2 {
                    font-size: 1.8rem;
                }

                .contact-header p {
                    font-size: 0.9rem;
                }

                .contact-details, .contact-form {
                    margin: 0;
                    padding: 1rem;
                    min-width: 100%;
                    width: 100%;  
                }

                .contact-form {
                    width: 100%;
                    box-sizing: border-box;  
                }
            }

            @media (max-width: 480px) {
                .contact-header h2 {
                    font-size: 1.6rem;
                }

                .contact-info p {
                    max-width: 200px;
                }

                .contact-details h3, .contact-form h3 {
                    font-size: 1.4rem;
                }

                .form-group label {
                    font-size: 0.9rem;
                }

                .form-group input, .form-group textarea {
                    font-size: 0.9rem;
                }

                .submit-btn {
                    padding: 0.75rem 1rem;
                    font-size: 0.9rem;
                }

                .contact-form {
                    width: 100%;
                    box-sizing: border-box; 
                }
            }
        </style>

        <footer class="site-footer">
            <div class="footer-container">
                <p>&copy; {{ date('Y') }} Navi Cargo. All rights reserved.</p>
            </div>
        </footer>

        <style>
            .site-footer {
                background-color: #fff;
                border-top: 2px solid #ddd;
                color: #000;
                padding: 30px 0;
                text-align: center;
                margin-top: 30px;
            }

            .site-footer .footer-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .site-footer p {
                margin: 0;
                font-size: 14px;
            }
        </style>

<div class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', function() {
            const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            
            // Show button when scrolled down more than 300px
            if (currentScrollPosition > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
        
        // Scroll to top when button is clicked
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>
