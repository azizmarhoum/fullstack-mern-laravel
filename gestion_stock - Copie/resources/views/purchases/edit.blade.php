@extends('layouts.app')

@section('title', 'Edit Purchase')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-warning-gradient text-white">
            <h3 class="mb-0">
                <i class="fas fa-edit me-2"></i>Modifier l'achat n°{{ $purchase->id }}
                <span class="badge bg-light text-dark float-end mt-1">
                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}
                </span>
            </h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('purchases.update', $purchase) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="product_id" class="form-label fw-bold text-secondary">Produit</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-warning">
                            <i class="fas fa-box text-warning"></i>
                        </span>
                        <select class="form-select border-start-0 ps-3" id="product_id" name="product_id" required style="height: 45px;">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $product->id == $purchase->product_id ? 'selected' : '' }}>
                                {{ $product->name }} (Stock actuel : {{ $product->stock }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="quantity" class="form-label fw-bold text-secondary">Quantité</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-warning">
                                <i class="fas fa-hashtag text-warning"></i>
                            </span>
                            <input type="number" class="form-control border-start-0 ps-3" id="quantity" name="quantity"
                                value="{{ $purchase->quantity }}" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="unit_cost" class="form-label fw-bold text-secondary">Coût unitaire ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-warning">
                                <i class="fas fa-dollar-sign text-warning"></i>
                            </span>
                            <input type="number" class="form-control border-start-0 ps-3" id="unit_cost" name="unit_cost"
                                value="{{ $purchase->unit_cost }}" step="0.01" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-warning-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-save me-2"></i>Mettre à jour l'achat
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

    .form-control:focus,
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
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection