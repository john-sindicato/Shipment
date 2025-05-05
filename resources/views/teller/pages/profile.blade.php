
@extends('teller.layout.layout')

@section('title', 'My Profile')

@section('content')
<style>
    .profile-advanced-container {
        width: 100%;
        margin-top: 20px;
        border-radius: 0;
        border: none;
        box-shadow: none;
        padding: 0;
        font-size: 16px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .profile-advanced-header {
        color: #fff;
        display: flex;
        align-items: center;
        border-bottom: 2px solid #ddd;
        width: 100%;
        padding: 20px 0;
        gap: 48px;
        min-height: 180px;
        box-sizing: border-box;
    }
    .profile-advanced-avatar {
        width: 170px;
        height: 170px;
        border-radius: 50%;
        border: 5px solid #fff;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0,0,0,0.10);
        background: #f9f9f9;
        flex-shrink: 0;
        transition: width 0.2s, height 0.2s;
    }
    .profile-advanced-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-advanced-header-info {
        flex: 1;
    }
    .profile-advanced-header-info h2 {
        margin: 0 0 10px 0;
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        word-break: break-word;
        color: #000;
    }
    .profile-advanced-header-info .profile-role {
        font-size: 1.2rem;
        font-weight: 500;
        color: #000;
        margin-top: 5px;
    }
    .profile-advanced-header-info .profile-email {
        font-size: 1.1rem;
        color: #000;
        word-break: break-all;
    }
    .profile-advanced-body {
        display: flex;
        flex-wrap: wrap;
        gap: 48px;
        padding: 40px 6vw 48px 6vw;
        min-height: 400px;
        box-sizing: border-box;
    }
    .profile-advanced-section {
        flex: 1 1 420px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(0,123,255,0.06);
        padding: 36px 32px;
        min-width: 340px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .profile-advanced-section h3 {
        font-size: 1.25rem;
        color: #007bff;
        margin-bottom: 24px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .profile-advanced-info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .profile-advanced-info-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f4fa;
        flex-wrap: wrap;
    }
    .profile-advanced-info-list li:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .profile-advanced-label {
        color: #555;
        font-weight: 500;
        font-size: 1.05rem;
        flex: 1 1 40%;
        min-width: 120px;
    }
    .profile-advanced-value {
        color: #222;
        font-weight: 600;
        font-size: 1.08rem;
        text-align: right;
        max-width: 60%;
        overflow-wrap: anywhere;
        flex: 1 1 60%;
    }

    @media (max-width: 1024px) {
        body {
            overflow: auto;
        }
        .profile-advanced-header {
            padding: 40px 20px;
            gap: 24px;
            min-height: 120px;
        }
        .profile-advanced-avatar {
            width: 100px;
            height: 100px;
        }
        .profile-advanced-header-info h2 {
            font-size: 2rem;
        }
        .profile-advanced-section {
            min-width: 220px;
            padding: 24px 12px;
        }
        .profile-advanced-body {
            gap: 24px;
            padding: 24px 2vw 24px 2vw;
        }
    }
 
    @media (max-width: 700px) {
        body {
            overflow: auto;
        }
        .profile-advanced-header { 
            margin-top: 90px;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            padding: 40px 20px;
            min-height: unset;
        }
        .profile-advanced-avatar {
            width: 70px;
            height: 70px;
            margin-bottom: 8px;
        }
        .profile-advanced-header-info h2 {
            font-size: 1.2rem;
        }
        .profile-advanced-header-info .profile-role,
        .profile-advanced-header-info .profile-email {
            font-size: 0.95rem;
        }
        .profile-advanced-body {
            flex-direction: column;
            gap: 16px;
            padding: 12px 2vw 24px 2vw;
            min-height: unset;
        }
        .profile-advanced-section {
            min-width: unset;
            width: 100%;
            padding: 14px 4vw;
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0,123,255,0.06);
        }
        .profile-advanced-section h3 {
            font-size: 1rem;
            margin-bottom: 14px;
        }
        .profile-advanced-info-list li {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 14px;
            padding-bottom: 6px;
        }
        .profile-advanced-label,
        .profile-advanced-value {
            font-size: 0.98rem;
            max-width: 100%;
            text-align: left;
        }
        .profile-advanced-label {
            margin-bottom: 2px;
        }
        .profile-advanced-value {
            font-weight: 500;
        }
    }
 
    @media (max-width: 400px) {
        body {
            overflow: auto;
        }
        .profile-advanced-header {
            padding: 40px 20px;
        }
        .profile-advanced-section {
            padding: 8px 2vw;
        }
    }
</style>

<div class="profile-advanced-container">
    <div class="profile-advanced-body">
        <div class="profile-advanced-header">
            <div class="profile-advanced-avatar">
                <img src="{{ asset(session('teller_profile', 'profiles/default.jpg')) }}" alt="Profile Picture">
            </div>
            <div class="profile-advanced-header-info">
                <h2>{{ session('teller_fname') }} {{ session('teller_lname') }}</h2>
                <div class="profile-email">{{ session('teller_email') }}</div>
                <div class="profile-role">Branch: {{ session('teller_branch') }}</div>
            </div>
        </div>
        <div class="profile-advanced-section">
            <h3>Personal Information</h3>
            <ul class="profile-advanced-info-list">
                <li>
                    <span class="profile-advanced-label">First Name</span>
                    <span class="profile-advanced-value">{{ session('teller_fname') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">Last Name</span>
                    <span class="profile-advanced-value">{{ session('teller_lname') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">Date of Birth</span>
                    <span class="profile-advanced-value">
                        {{ \Carbon\Carbon::parse(session('teller_dob'))->format('F j, Y') }}
                    </span>
                </li>
                <li>
                    <span class="profile-advanced-label">Gender</span>
                    <span class="profile-advanced-value">{{ session('teller_gender') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">Phone Number</span>
                    <span class="profile-advanced-value">{{ session('teller_phone') }}</span>
                </li>
            </ul>
        </div>
        <div class="profile-advanced-section">
            <h3>Address</h3>
            <ul class="profile-advanced-info-list">
                <li>
                    <span class="profile-advanced-label">Street Address</span>
                    <span class="profile-advanced-value">{{ session('teller_street') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">Subdivision / Barangay</span>
                    <span class="profile-advanced-value">{{ session('teller_brgy') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">City</span>
                    <span class="profile-advanced-value">{{ session('teller_city') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">Province</span>
                    <span class="profile-advanced-value">{{ session('teller_province') }}</span>
                </li>
                <li>
                    <span class="profile-advanced-label">Postal / Zip Code</span>
                    <span class="profile-advanced-value">{{ session('teller_zipcode') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
