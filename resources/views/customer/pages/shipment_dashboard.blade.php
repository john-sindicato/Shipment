
@extends('customer.layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
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
        
    .container {
        width: 100%;
        max-width: 1170px; 
        padding-top: 10px; 
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        border-bottom: 1px solid #ddd;
        position: relative;
        padding-bottom: 15px;
        flex-wrap: wrap;
    }

    .dashboard-title {
        font-family: 'Manrope', sans-serif;
        font-size: 2.5rem;
        font-weight: 100;
        color: var(--text-primary); 
        position: relative; 
        flex: 1 1 100%;
    }

    .dashboard-subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem; 
        margin-top: 10px;
        text-align: center;
        flex: 1 1 100%;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            margin: 4% auto;
        }
        .dashboard-title {
            font-size: 2rem;
        }

        .dashboard-subtitle {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .dashboard-header {
            margin: 4% auto;
        }
        .dashboard-title {
            font-size: 1.5rem;
        }

        .dashboard-subtitle {
            font-size: 0.9rem;
        }
    }
 
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
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
        display: flex;
        flex-direction: column; 
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

    .stat-card-link, .stat-card {
        cursor: pointer;
    }
    .stat-card-cta {
        align-self: flex-end;
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        font-size: 0.95rem;
        color: #000;
        font-weight: 500;
        gap: 0.4em;
        opacity: 0.85;
        transition: color 0.2s;
    }
    .stat-card-link:hover .stat-card-cta {
        color: var(--primary-dark);
        opacity: 1;
    }
    .stat-card-cta i {
        font-size: 1em;
        margin-left: 0.2em;
    }
</style>
</head>
<body>
    @section('content')
        <div class="container">
            <div class="dashboard-header">
                <div>
                    <h1 class="dashboard-title">Shipment Dashboard</h1>
                    <p class="dashboard-subtitle">Stay updated and monitor the status of your shipment.</p>
                </div>             
            </div>

            <div class="card-grid"> 
                <a href="{{ route('customer.pages.shipment.pending') }}" class="stat-card-link">
                    <div class="stat-card blue">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $pending }}</div>
                                <div class="stat-card-title">Pending</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-inbox stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            New shipment requests awaiting review and approval.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
 
                <a href="{{ route('customer.pages.shipment.approved') }}" class="stat-card-link">
                    <div class="stat-card green">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $approved }}</div>
                                <div class="stat-card-title">Approved</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-check-circle stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that have been approved and are ready for processing.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
 
                <a href="{{ route('customer.pages.shipment.queued') }}" class="stat-card-link">
                    <div class="stat-card yellow">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $queued }}</div>
                                <div class="stat-card-title">Queued</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-clock stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Approved shipments waiting in the queue for processing.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
 
                <a href="{{ route('customer.pages.shipment.in_transit') }}" class="stat-card-link">
                    <div class="stat-card purple">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $inTransitCount }}</div>
                                <div class="stat-card-title">In Transit</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-truck-moving stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments currently being transported to their destinations.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
 
                <a href="{{ route('customer.pages.shipment.dispatched') }}" class="stat-card-link">
                    <div class="stat-card teal">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $dispatchedCount }}</div>
                                <div class="stat-card-title">Dispatched</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-paper-plane stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that have been dispatched for final delivery.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('customer.pages.shipment.claimed') }}" class="stat-card-link">
                    <div class="stat-card red">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $claimed }}</div>
                                <div class="stat-card-title">Claimed</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-clipboard-check stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that have been successfully received and claimed by your receiver.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('customer.pages.shipment.unclaim') }}" class="stat-card-link">
                    <div class="stat-card red">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $unclaim }}</div>
                                <div class="stat-card-title">Unclaim</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-archive stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that have not been claimed by your receiver.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
 
                <a href="{{ route('customer.pages.shipment.cancelled') }}" class="stat-card-link">
                    <div class="stat-card red">
                        <div class="stat-card-header">
                            <div class="stat-card-content">
                                <div class="stat-card-count">{{ $cancelled }}</div>
                                <div class="stat-card-title">Cancelled</div>
                            </div>
                            <div class="stat-card-icon-wrapper">
                                <div class="stat-card-icon-bg"></div>
                                <i class="fas fa-times-circle stat-card-icon"></i>
                            </div>
                        </div>
                        <div class="stat-card-description">
                            Shipments that were cancelled and will not proceed further.
                        </div>
                        <div class="stat-card-cta">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>                                          
    @endsection
</body>
</html>
