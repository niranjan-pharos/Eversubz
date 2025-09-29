@extends('layouts.eventlayout')

@section('title', 'Fundraiser Success page | Eversabz')
@section('description', 'Welcome to Eversabz')

@section('content')
    <style>
         /* Center wrapper */
        .donation-receipt-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Receipt Card */
        .donation-receipt-card {
            min-width: 420px;
            border-radius: 15px;
            border: 1px solid #000;
            padding: 20px;
            background: linear-gradient(136.83deg, rgb(33 178 171 / 10%) 2.01%, rgba(11, 167, 144, 0) 48.82%);
        }

        /* Heading */
        .receipt-heading {
            font-size: 2.2rem;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 15px;
        }

        /* Receipt Number */
        .donation-number span {
            color: #000;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: bold;
        }

        /* Section Heading */
        .details-heading {
            font-size: 1.4rem;
            font-weight: bold;
            margin: 15px 0;
            color: #007bff;
        }

        /* List Items */
        .donation-receipt-card .list-group-item {
            font-size: 1rem;
            padding: 12px 18px;
            border: none;
            border-bottom: 1px dashed #ddd;
        }
        .donation-receipt-card .list-group-item:last-child {
            border-bottom: none;
        }

        /* Amount Colors */
        .amount-donated { color: #000; font-weight: bold; }
        .amount-tip { color: #000; font-weight: bold; }
        .amount-fee { color: #000; font-weight: bold; }
        .amount-total { color: #000; font-weight: bold; }


        /* Receipt List Alignment */
        .receipt-list .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1rem;
            padding: 12px 18px;
            border: none;
            border-bottom: 1px dashed #ddd;
        }

        .receipt-list .list-group-item:last-child {
            border-bottom: none;
        }

        /* Amounts right aligned */
        .receipt-list .list-group-item span:last-child {
            text-align: right;
            min-width: 100px;   /* keeps amounts aligned */
            font-weight: bold;
        }


        /* Return Home Button */
        .return-home-btn {
            display: inline-block;
            margin-top: 15px;
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: #fff;
            font-size: 1.1rem;
            padding: 12px 40px;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
        }
        .return-home-btn:hover {
            background: linear-gradient(135deg, #6610f2, #007bff);
            transform: translateY(-2px);
        }

        /* Responsive for ≤767px (mobiles) */
        @media (max-width: 767px) {
            .donation-receipt-card {
                min-width: 100%;       /* full width */
                max-width: 600px;
                padding: 15px;         /* smaller padding */
                border-radius: 10px;   /* less curve for small screens */
            }

            .receipt-heading {
                font-size: 1.6rem;     /* smaller heading on mobile */
            }

            .details-heading {
                font-size: 1.2rem;
            }

            .receipt-list .list-group-item {
                font-size: 0.95rem;    /* adjust text for mobile */
                padding: 10px 12px;
            }

            .return-home-btn {
                width: 100%;           /* full width button on mobile */
                padding: 12px;
                font-size: 1rem;
            }
        }

        /* Success Circle */
        .success-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            animation: scaleIn 0.6s ease forwards;
        }

        /* Checkmark */
        .checkmark {
            width: 40px;
            height: 20px;
            border-left: 5px solid white;
            border-bottom: 5px solid white;
            transform: rotate(-45deg);
            opacity: 0;
            animation: drawCheck 0.6s ease 0.5s forwards;
        }

        /* Circle Pop-in */
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            80% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Check Draw Animation */
        @keyframes drawCheck {
            0% { width: 0; height: 0; opacity: 0; }
            50% { width: 40px; height: 0; opacity: 1; }
            100% { width: 40px; height: 20px; opacity: 1; }
        }
        
    </style>

    <div class="container mt-5" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <!-- Success Banner -->
                <div class="alert alert-success text-center">
                    <h3>Donation Successful!</h3>
                    <p>Thank you for your generous donation. Your support is making a difference!</p>
                    <p>Your donation number is: <strong>{{ session('donation_number') }}</strong></p>
                </div>

                <!-- Donation Summary -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Donation Details</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Amount Donated:</strong> ${{ number_format(session('donation_amount'), 2) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Tip Amount:</strong> ${{ number_format(session('tip_amount'), 2) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Transaction Fee:</strong> ${{ number_format(session('transaction_fee'), 2) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Total Amount:</strong> ${{ number_format(session('total_amount'), 2) }}
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Call to Action or Next Steps -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 donation-receipt-wrapper mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                
                <!-- Receipt Card -->
                <div class="card donation-receipt-card shadow-lg">
                    <div class="card-body text-center">
                        
                        <!-- Heading -->
                        <div class="success-icon">
                            <div class="checkmark"></div>
                        </div>
                        <h1 class="receipt-heading"> Donation Successful!</h1>
                        <p class="lead">Thank you for your generous donation. Your support is making a difference!</p>
                        <p class="donation-number mb-5">
                            Your donation number is: <span>{{ session('donation_number') }}</span>
                        </p>

                        <hr>

                        <!-- Donation Details -->
                        <h4 class="details-heading">Donation Details</h4>
                        <ul class="list-group list-group-flush receipt-list">
                            <li class="list-group-item">
                                <span><strong>Amount Donated :</strong></span>
                                <span class="amount-donated">${{ number_format(session('donation_amount'), 2) }}</span>
                            </li>
                            <li class="list-group-item">
                                <span><strong>Tip Amount :</strong></span>
                                <span class="amount-tip">${{ number_format(session('tip_amount'), 2) }}</span>
                            </li>
                            <li class="list-group-item">
                                <span><strong>Transaction Fee :</strong></span>
                                <span class="amount-fee">${{ number_format(session('transaction_fee'), 2) }}</span>
                            </li>
                            <li class="list-group-item total-row">
                                <span><strong>Total Amount :</strong></span>
                                <span class="amount-total">${{ number_format(session('total_amount'), 2) }}</span>
                            </li>
                        </ul>

                        <hr>
                        
                        <!-- Call to Action -->
                        <a href="{{ route('home') }}" class="btn return-home-btn">⬅ Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
