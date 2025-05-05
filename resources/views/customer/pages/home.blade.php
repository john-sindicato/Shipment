@extends('customer.layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
<style>
    .about-section {
        background-color: #fff;
        color: #333;  
        border-radius: 20px;  
        font-family: Arial, sans-serif;
        animation: fadeIn 0.5s ease-in-out;
        width: 100%;
        max-width: 1170px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .welcome-message {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px; 
        padding: 10px 0;
    }
    .welcome-message-text {
        flex: 1.2;
        text-align: justify;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .welcome-message-text h1 {
        text-align: left;
        font-size: 2rem;
        margin-bottom: 10px;
        font-weight: 300;
        color: #222;
    }
    .welcome-message-text p {
        text-align: justify;
        font-size: 1.2rem;
        color: #444;
    }
    .welcome-message-image {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 500px;          
        max-width: 100%;
    }
    .welcome-message-image img { 
        width: 100%;         
        height: 200px;
        border-radius: 5px;
        box-shadow: 0 6px 24px rgba(0,0,0,0.13);
        object-fit: cover;
    }
    @media (max-width: 900px) {
        .welcome-message {
            flex-direction: column;
            gap: 20px;
            padding: 20px 0;
        }
        .welcome-message-image img {
            width: 100%;
            max-width: 350px;
        }
        .welcome-message-text h1 {
            font-size: 1.5rem;
        }
    }
    @media (max-width: 600px) {
        .welcome-message {
            padding: 10px 0;
        }
        .welcome-message-image img {
            max-width: 100%;
            width: 100%;
        }
        .welcome-message-text h1 {
            font-size: 1.1rem;
        }
        .welcome-message-text p {
            font-size: 1rem;
        }
    }

    .about-section p {
        line-height: 1.6;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .welcome-message { 
        text-align: justify;
    } 

    .intro, .scroll-content {
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: justify;
    }

    .about-navi-cargo-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;  
        padding: 30px 0 50px 0;  
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;
    }

    .about-navi-cargo-text {
        flex: 1;
        text-align: justify;
    }

    .about-navi-cargo-text h2 {
        color: #000;
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: 100;
    }

    .about-navi-cargo-text p {
        font-size: 16px;
        line-height: 1.6;
        color: #000;
        margin-bottom: 15px;
    }

    .about-navi-cargo-image {
        flex: 1;
        text-align: center;
    }

    .about-navi-cargo-image img {
        max-width: 100%;
        height: auto; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        .about-navi-cargo-container {
            flex-direction: column;
            gap: 20px;
            padding: 20px 0;
        }

        .about-navi-cargo-text h2 {
            font-size: 24px;
        }

        .about-navi-cargo-text p {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .about-navi-cargo-container {
            padding: 15px 0;
        }

        .about-navi-cargo-text h2 {
            font-size: 20px;
        }

        .about-navi-cargo-text p {
            font-size: 13px;
        }
    }

    .scroll-content {
        background-color: #ffffff;   
        border-left: none;
        border-radius: 15px;
        padding: 0px; 
        margin-bottom: 30px;
        line-height: 1.8; 
        color: #333; 
    }

    .scroll-content p {
        margin-bottom: 20px; 
        text-align: justify;  
        font-size: 1.1rem; 
    }

    .scroll-content p:last-of-type {
        font-style: italic;
        color: #000;
        text-align: center;
    }

    .scroll-content h2 {
        color: #000;
        font-size: 1.8rem;
        font-weight: 100;
        text-align: left; 
        margin-bottom: 20px;
        border-bottom: 2px solid #000;
        padding-bottom: 5px;
    }

    @media (max-width: 768px) {
        .about-section, 
        .welcome-message, 
        .intro, 
        .scroll-content, 
        .why-choose {
            padding: 10px;
            border-radius: 10px; 
            margin-bottom: 20px;
        }

        .about-section h1,
        .why-choose h2,
        .scroll-content h2 {
            font-size: 1.5rem;
        }

        .about-section p,
        .scroll-content p,
        .why-choose li {
            font-size: 1rem;
            line-height: 1.5;
        }

        .why-choose li {
            padding: 10px 0;
        }

        .scroll-content p:last-of-type {
            font-size: 1rem;
        }

        .welcome-message h1 {
            font-size: 1.6rem;
        }

        .welcome-message p {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .about-section, 
        .welcome-message, 
        .intro, 
        .scroll-content, 
        .why-choose {
            padding: 15px;
            border-radius: 8px;
        }

        .about-section h1,
        .why-choose h2,
        .scroll-content h2 {
            font-size: 1.3rem;
        }

        .about-section p,
        .scroll-content p,
        .why-choose li {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .welcome-message h1 {
            font-size: 1.4rem;
        }

        .welcome-message p {
            font-size: 0.95rem;
        }
    }
</style>
</head>
<body>
    @section('content')
    <div class="about-section">
        <div class="welcome-message">
            <div class="welcome-message-text">
                <h1>Hi {{ Auth::user()->fname }}, Welcome to Navi Cargo</h1>
                <p>
                    We're thrilled to have you with us. At Navi Cargo, we’re dedicated to providing a smooth and reliable shipping experience tailored to your needs. Whether you’re managing frequent shipments or sending a one-time package, our team is here to support you every step of the way. Let’s move forward together with confidence and convenience.
                </p>
            </div>
            <div class="welcome-message-image">
                <img src="{{ asset('img/welcome.avif') }}" alt="Welcome to Navi Cargo">
            </div>
        </div>           
    
        <div class="intro">
            <p>At Navi Cargo, we understand that shipping is more than just moving items. It's about ensuring your valuable products, business materials, or personal packages arrive safely, securely, and on time. Whether you're a business professional managing crucial shipments or an individual sending personal belongings, we prioritize the seamless experience and peace of mind you deserve. Our global network, advanced tracking systems, and dedicated team of experts are committed to providing a reliable, affordable, and efficient service. With Navi Cargo, your shipments are handled with the utmost care, transparency, and attention to detail, ensuring every delivery meets your expectations. Whether you're a business professional or an individual, we’re committed to giving you the best shipping experience possible.</p>
        </div>
    
        <div class="about-navi-cargo-container">
            <div class="about-navi-cargo-text">
                <h2>Our Commitment to You</h2>
                <p>
                    At Navi Cargo, we believe shipping is more than logistics — it’s a vital connection between people, places, and possibilities. Every item we move tells a unique story, whether it’s a gift for a loved one, an essential business supply, or a symbol of someone’s hard work.
                </p>
                <p>
                    We’re not just in the business of delivery — we’re in the business of trust. From pickup to drop-off, we treat every shipment with the care and reliability it deserves, ensuring that each mile we travel brings you closer to your goals.
                </p>
                <p>
                    With Navi Cargo, you’re not just sending packages — you’re moving forward with a partner that values your journey as much as you do.
                </p>                
            </div>
            <div class="about-navi-cargo-image">
                <img src="{{ asset('img/cargo.jpg') }}" alt="Navi Cargo Journey">
            </div>
        </div>        
    
        <div class="scroll-content">
            <h2>Your Logistics Partner</h2>
            <p>At Navi Cargo, we specialize in providing efficient and secure local shipping solutions, ensuring your packages move seamlessly from one port to another. Whether you’re a business owner managing supplies or an individual sending essential goods, we are committed to making your shipping experience smooth and worry-free.</p>

            <p>Our port-to-port delivery services are designed to meet your local logistics needs with precision and reliability. We understand the importance of timely deliveries, especially for businesses relying on shipments to maintain their operations. With Navi Cargo, you can count on prompt handling, accurate tracking, and dependable service every step of the way.</p>

            <p>We take pride in our secure handling procedures. Each shipment is treated with care to ensure it reaches its destination safely. From proper packaging techniques to organized loading processes, our team follows strict protocols to minimize risks during transit. Whether you’re shipping delicate items, bulk goods, or urgent documents, we’ve got you covered.</p>

            <p>Transparency is key to our service. Our advanced tracking system allows you to monitor your shipment in real-time, giving you full visibility from the point of departure to the final port. We also provide regular updates, so you’ll always know where your package is and when to expect its arrival.</p>

            <p>At Navi Cargo, we understand that no two shipments are the same. That's why we offer flexible solutions tailored to your specific needs. Whether you're managing small packages or coordinating bulk deliveries, our team is equipped to handle it efficiently. Our competitive pricing ensures you get reliable service without unexpected costs or hidden fees.</p>

            <p>Customer satisfaction is our top priority. Our dedicated support team is always ready to assist you with inquiries, booking guidance, or shipment updates. We are committed to delivering a positive experience, ensuring your items reach their destination securely and on time.</p>

            <p>Experience the convenience of fast, secure, and reliable port-to-port shipping with Navi Cargo. Discover how we simplify logistics to keep your shipments moving with confidence. Let us handle your shipping needs so you can focus on what matters most — your business and your customers.</p>
            <p>Thank you for choosing Navi Cargo. Let’s make your shipping experience smooth, secure, and reliable every step of the way.</p>
        </div>
    </div>
    @endsection
</body>
</html>