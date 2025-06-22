@extends('layouts.app')

@section('title', 'Modifier Commande')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-warning-gradient text-white">
            <h3 class="mb-0">
                <i class="fas fa-edit me-2"></i>Modifier Commande #{{ $order->id }}
                <span class="badge bg-light text-dark float-end mt-1">
                    {{ ucfirst($order->status) }}
                </span>
            </h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Statut de la Commande</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-warning">
                            <i class="fas fa-tag text-warning"></i>
                        </span>
                        <select name="status" class="form-select border-start-0 ps-3" style="height: 45px;">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                    <button type="submit" class="btn btn-warning-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-save me-2"></i>Mettre à Jour Commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-warning-gradient {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    }

    .bg-light-warning {
        background-color: #fef5e7;
    }

    .btn-warning-gradient {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-warning-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(243, 156, 18, 0.2);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .form-select:focus {
        border-color: #f39c12;
        box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
    }

    .input-group-text {
        border-right: none;
    }

    .border-start-0 {
        border-left: none;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.35rem 0.65rem;
        text-transform: capitalize;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection