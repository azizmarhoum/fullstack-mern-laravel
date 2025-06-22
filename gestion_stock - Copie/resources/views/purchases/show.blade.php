@extends('layouts.app')

@section('title', 'Purchase Details')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-blue-gradient text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Purchase #{{ $purchase->id }}
                    <span class="badge bg-light text-dark ms-2">
                        {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('M d, Y') }}
                    </span>
                </h3>
                <a href="{{ route('purchases.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-light-blue-soft">
                        <div class="card-body">
                            <h5 class="card-title text-light-blue">
                                <i class="fas fa-box me-2"></i>Product Details
                            </h5>
                            <p class="mb-1"><strong>Name:</strong> {{ $purchase->product->name }}</p>
                            <p class="mb-1"><strong>Category:</strong> {{ $purchase->product->category }}</p>
                            <p class="mb-0"><strong>Current Stock:</strong> {{ $purchase->product->stock }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-light-blue-soft">
                        <div class="card-body">
                            <h5 class="card-title text-light-blue">
                                <i class="fas fa-receipt me-2"></i>Purchase Information
                            </h5>
                            <p class="mb-1"><strong>Quantity:</strong> {{ $purchase->quantity }}</p>
                            <p class="mb-1"><strong>Unit Cost:</strong> ${{ number_format($purchase->unit_cost, 2) }}</p>
                            <p class="mb-0"><strong>Date:</strong> {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 bg-blue-gradient text-white">
                <div class="card-body text-center">
                    <h4 class="mb-1">Total Purchase Cost</h4>
                    <h2 class="mb-0">${{ number_format($purchase->total_cost, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --light-blue: #5dade2;
        --light-blue-dark: #3498db;
        --light-blue-soft: #ebf5fb;
    }

    /* Blue gradient header */
    .bg-blue-gradient {
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--light-blue-dark) 100%);
    }

    /* Card styling */
    .card {
        border-radius: 12px;
    }

    /* Light blue background */
    .bg-light-blue-soft {
        background-color: var(--light-blue-soft);
        transition: all 0.3s ease;
    }

    .bg-light-blue-soft:hover {
        box-shadow: 0 4px 8px rgba(93, 173, 226, 0.1);
    }

    /* Text colors */
    .text-light-blue {
        color: var(--light-blue-dark);
    }

    /* Badge styling */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }

    /* Button styling */
    .btn-light {
        background-color: white;
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection