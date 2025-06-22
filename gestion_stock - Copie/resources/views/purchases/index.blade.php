@extends('layouts.app')

@section('title', 'Purchases')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-blue-gradient text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-shopping-basket me-2"></i>Purchase Records</h3>
                <a href="{{ route('purchases.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Record Purchase
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-blue-soft">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Produit</th>
                            <th>Qté</th>
                            <th>Coût unitaire</th>
                            <th>Coût total</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                        <tr class="border-bottom border-light">
                            <td class="ps-4 fw-bold text-light-blue">#{{ $purchase->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light-blue rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                    {{ $purchase->product->name }}
                                </div>
                            </td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>${{ number_format($purchase->unit_cost, 2) }}</td>
                            <td class="fw-bold text-success">${{ number_format($purchase->total_cost, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('M d, Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-sm btn-soft-info rounded-start-pill px-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-sm btn-soft-warning px-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-soft-danger rounded-end-pill px-3">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

    /* Soft blue background */
    .bg-light-blue-soft {
        background-color: var(--light-blue-soft);
    }

    /* Button styles */
    .btn-soft-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
        transition: all 0.2s ease;
    }

    .btn-soft-warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
        transition: all 0.2s ease;
    }

    .btn-soft-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
        transition: all 0.2s ease;
    }

    .btn-soft-info:hover, .btn-soft-warning:hover, .btn-soft-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Avatar styling */
    .avatar-sm {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }

    /* Card styling */
    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    /* Table styling */
    .table-hover tbody tr:hover {
        background-color: rgba(93, 173, 226, 0.05);
    }

    /* Text colors */
    .text-light-blue {
        color: var(--light-blue-dark);
    }

    .text-success {
        color: #28a745 !important;
    }

    /* Rounded pills */
    .rounded-pill {
        border-radius: 50px !important;
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection