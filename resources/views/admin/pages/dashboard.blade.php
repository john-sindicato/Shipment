@extends('admin.layout.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Command Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            --card-bg: #ffffff;
            --card-bg-hover: #f8fafc;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.08);
            --card-border: rgba(226, 232, 240, 0.6);
            
            --primary: #475569;
            --primary-light: #94a3b8;
            --primary-dark: #334155;
            
            --blue: #3b82f6;
            --blue-light: #dbeafe;
            --purple: #8b5cf6;
            --purple-light: #ede9fe;
            --green: #10b981;
            --green-light: #d1fae5;
            --yellow: #f59e0b;
            --yellow-light: #fef3c7;
            --red: #ef4444;
            --red-light: #fee2e2;
            --teal: #14b8a6;
            --teal-light: #ccfbf1;
            
            --text-primary: #000;
            --text-secondary: #000;
            --text-tertiary: #000;
            --text-muted: #000;
            
            --progress-bg: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow: auto;
            position: relative;
        }

        .dashboard { 
            margin: 6% auto; 
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid #ddd;
            position: relative;
            padding-bottom: 15px;
            animation: fadeIn 1s ease-out forwards;
        }

     /* Adding the fade-in animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
 
        .dashboard-title {
            font-family: 'Manrope', sans-serif;
            font-size: 2.5rem;
            font-weight: 100;
            color: var(--text-primary); 
            position: relative; 
        }

        .dashboard-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem; 
        }

        .dashboard-date {
            font-family: 'Manrope', sans-serif;
            font-size: 1rem;
            color: var(--text-tertiary);
            background-color: var(--card-bg);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--card-border);
        }

        /* Grid Layout */ 
        @keyframes fadeInUpGrid {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 3rem;
            position: relative;
            animation: fadeInUpGrid 1s ease-out forwards; 
        }

        .stat-card-link {
            text-decoration: none; 
            color: inherit;  
            display: block;
            transition: transform 0.3s ease;
        }

        /* Card Design */
        .stat-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--card-border);
            box-shadow: var(--card-shadow);
            border: 1px solid #ddd;
            z-index: 1;
            width: 100%;   
            height: 100%;   
            box-sizing: border-box;  
        }

        .stat-card-link:hover {
            transform: translateY(-5px);
        }

        .stat-card-link:hover .stat-card {
            box-shadow: var(--card-shadow-hover);
            background-color: var(--card-bg-hover);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at top right, var(--glow-color, transparent) 0%, transparent 70%);
            opacity: 0.05;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .stat-card-link:hover .stat-card::before {
            opacity: 0.1;
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            position: relative;
        }

        .stat-card-icon-wrapper {
            position: relative;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card-icon-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            background-color: var(--icon-bg, var(--blue-light));
            opacity: 0.2;
            transform: rotate(45deg);
            transition: transform 0.3s ease;
        }

        .stat-card-link:hover .stat-card-icon-bg {
            transform: rotate(0deg);
        }

        .stat-card-icon {
            position: relative;
            z-index: 2;
            font-size: 1.25rem;
            color: var(--icon-color, var(--blue));
        }

        .stat-card-content {
            position: relative;
        }

        .stat-card-count {
            font-family: 'Manrope', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-card-title {
            font-size: 0.875rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .stat-card-description {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .stat-card-trend {
            display: inline-flex;
            align-items: center;
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            background-color: var(--trend-bg, rgba(226, 232, 240, 0.5));
        }

        .trend-up {
            color: var(--green);
            --trend-bg: rgba(16, 185, 129, 0.1);
        }

        .trend-down {
            color: var(--red);
            --trend-bg: rgba(239, 68, 68, 0.1);
        }

        .trend-neutral {
            color: var(--text-tertiary);
            --trend-bg: rgba(148, 163, 184, 0.2);
        }

        .trend-icon {
            margin-right: 0.5rem;
        }

        /* Section Titles */
        .section-container {
            margin-bottom: 2.5rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-icon {
            font-size: 1.125rem;
            margin-right: 1rem;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: var(--card-bg);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--card-border);
            color: var(--section-icon-color, var(--primary));
            animation: fadeInUpGrid 1s ease-out forwards;
        }

        .section-title {
            font-family: 'Manrope', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            position: relative;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            animation: fadeInUpGrid 1s ease-out forwards;
        }

        /* Floating Elements - More subtle */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.03;
            z-index: -1;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background-color: var(--blue);
            top: -100px;
            right: 10%;
            animation: float 15s ease-in-out infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background-color: var(--purple);
            bottom: 10%;
            left: 5%;
            animation: float 20s ease-in-out infinite reverse;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background-color: var(--teal);
            bottom: 20%;
            right: 15%;
            animation: float 18s ease-in-out infinite 2s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(5%, 5%) rotate(5deg); }
            50% { transform: translate(0, 10%) rotate(0deg); }
            75% { transform: translate(-5%, 5%) rotate(-5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        /* Card Variations */
        .blue {
            --icon-color: var(--blue);
            --icon-bg: var(--blue-light);
            --glow-color: var(--blue-light);
            --progress-color: var(--blue);
        }

        .purple {
            --icon-color: var(--purple);
            --icon-bg: var(--purple-light);
            --glow-color: var(--purple-light);
            --progress-color: var(--purple);
        }

        .green {
            --icon-color: var(--green);
            --icon-bg: var(--green-light);
            --glow-color: var(--green-light);
            --progress-color: var(--green);
        }

        .yellow {
            --icon-color: var(--yellow);
            --icon-bg: var(--yellow-light);
            --glow-color: var(--yellow-light);
            --progress-color: var(--yellow);
        }

        .red {
            --icon-color: var(--red);
            --icon-bg: var(--red-light);
            --glow-color: var(--red-light);
            --progress-color: var(--red);
        }

        .teal {
            --icon-color: var(--teal);
            --icon-bg: var(--teal-light);
            --glow-color: var(--teal-light);
            --progress-color: var(--teal);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .dashboard {
                margin: 39% auto;
            }
            .card-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                padding: 1.5rem;
                margin: 39% auto;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .dashboard-date {
                margin-top: 1rem;
            }

            .card-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 1.25rem;
            }

            .stat-card-count {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .dashboard {
                padding: 1rem;
                margin: 39% auto;
            }

            .card-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>

    <div class="dashboard">
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Track and manage all operations statuses in real-time</p>
            </div>                                        
            <div class="dashboard-date" id="current-date">Loading date...</div>
        </div>

        <div class="section-container">
            <div class="section-header">
                <div class="section-icon" style="color: var(--blue);">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h2 class="section-title">Shipment</h2>
                <div class="section-line"></div>
            </div>

            <div class="card-grid">
                <a href="{{ route('admin.pages.shipments.submitted_request') }}" class="stat-card-link">
                    <div class="stat-card blue">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $request }}</div>
                                <div class="stat-card-title">Shipment Requests</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-shipping-fast stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            New shipment requests awaiting admin review and approval for processing.
                        </div>
                    </div>
                </a>
            
                <a href="{{ route('admin.pages.shipments.queued') }}" class="stat-card-link">
                    <div class="stat-card yellow">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $queued }}</div>
                                <div class="stat-card-title">Queued Shipment</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-clock stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Approved shipments now queued and ready for dispatch or pickup.
                        </div>
                    </div>
                </a>
            
                <a href="{{ route('admin.pages.shipments.in_transit') }}" class="stat-card-link">
                    <div class="stat-card purple">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $inTransitCount }}</div>
                                <div class="stat-card-title">In Transit Shipment</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-truck-moving stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            These shipments are on the way to their destination and currently being tracked.
                        </div>
                    </div>
                </a>
            
                <a href="{{ route('admin.pages.shipments.dispatched') }}" class="stat-card-link">
                    <div class="stat-card green">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $dispatchedCount }}</div>
                                <div class="stat-card-title">Dispatched Shipment</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-check-circle stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            These shipments have arrived at the target branch and are ready for claiming.
                        </div>
                    </div>
                </a>
            
                <a href="{{ route('admin.pages.shipments.claimed') }}" class="stat-card-link">
                    <div class="stat-card green">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $claimed }}</div>
                                <div class="stat-card-title">Claimed Shipment</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-clipboard-check stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that have been successfully received and claimed by the recipient.
                        </div>
                    </div>
                </a>
            
                <a href="{{ route('admin.pages.shipments.unclaim') }}" class="stat-card-link">
                    <div class="stat-card red">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $unclaim }}</div>
                                <div class="stat-card-title">Unclaim Shipment</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-archive stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that have not been claimed by the recipient.
                        </div>
                    </div>
                </a>
            
                <a href="{{ route('admin.pages.shipments.cancelled') }}" class="stat-card-link">
                    <div class="stat-card red">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $cancelled }}</div>
                                <div class="stat-card-title">Cancelled Shipment</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-times-circle stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that were cancelled by the customer or teller before dispatch.
                        </div>
                    </div>
                </a>
            </div>            
        </div>

        <div class="section-container">
            <div class="section-header">
                <div class="section-icon" style="color: var(--purple);">
                    <i class="fas fa-users"></i>
                </div>
                <h2 class="section-title">Tellers & Users</h2>
                <div class="section-line"></div>
            </div>

            <div class="card-grid">
                <!-- Tellers -->
                <a href="{{ route('admin.pages.accounts.teller') }}" class="stat-card-link">
                    <div class="stat-card purple">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $tellersCount }}</div>
                                <div class="stat-card-title">Tellers</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-user-tie stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Front-line staff handling customer inquiries and processing shipping requests at branches.
                        </div>
                    </div>
                </a>

                <!-- Users -->
                <a href="{{ route('admin.pages.accounts.user') }}" class="stat-card-link">
                    <div class="stat-card blue">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $usersCount }}</div>
                                <div class="stat-card-title">Users</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-users stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Total registered customers who use our shipping services across all platforms.
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="section-container">
            <div class="section-header">
                <div class="section-icon" style="color: var(--teal);">
                    <i class="fas fa-route"></i>
                </div>
                <h2 class="section-title">Routes</h2>
                <div class="section-line"></div>
            </div>

            <div class="card-grid">
                <!-- Available Routes -->
                <a href="{{ route('admin.pages.rates.rates') }}" class="stat-card-link">
                    <div class="stat-card teal">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $openRoutes }}</div>
                                <div class="stat-card-title">Available Routes</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-route stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Active shipping routes currently available for customer shipments and deliveries.
                        </div>
                    </div>
                </a>

                <!-- Unavailable Routes -->
                <a href="{{ route('admin.pages.rates.rates') }}" class="stat-card-link">
                    <div class="stat-card yellow">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $closedRoutes }}</div>
                                <div class="stat-card-title">Unavailable Routes</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-ban stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Routes temporarily unavailable due to weather conditions, carrier issues, or other disruptions.
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="section-container">
            <div class="section-header">
                <div class="section-icon" style="color: var(--green);">
                    <i class="fas fa-building"></i>
                </div>
                <h2 class="section-title">Branch</h2>
                <div class="section-line"></div>
            </div>

            <div class="card-grid">
                <!-- Open Branches -->
                <a href="{{ route('admin.pages.company.branch') }}" class="stat-card-link">
                    <div class="stat-card green">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $openBranches }}</div>
                                <div class="stat-card-title">Open Branches</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-door-open stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Operational branch locations currently serving customers and processing shipments.
                        </div>
                    </div>
                </a>

                <!-- Closed Branches -->
                <a href="{{ route('admin.pages.company.branch') }}" class="stat-card-link">
                    <div class="stat-card red">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $closedBranches }}</div>
                                <div class="stat-card-title">Closed Branches</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-door-closed stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Branch locations temporarily closed due to maintenance, staffing issues, or holidays.
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Set current date with time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
        }
        
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Animate progress bars on load
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.getPropertyValue('--progress-width');
                bar.style.setProperty('--progress-width', '0%');
                
                setTimeout(() => {
                    bar.style.setProperty('--progress-width', width);
                }, 300);
            });
        });
    </script>
</body>
</html>
@endsection
