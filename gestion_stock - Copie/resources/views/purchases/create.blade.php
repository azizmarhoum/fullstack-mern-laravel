@extends('layouts.app')

@section('title', 'Record Purchase')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-info-gradient text-white">
            <h3 class="mb-0"><i class="fas fa-cart-plus me-2"></i>Enregistrer un nouvel achat</h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="product_id" class="form-label fw-bold text-secondary">Produit</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-info">
                            <i class="fas fa-box text-info"></i>
                        </span>
                        <select class="form-select border-start-0 ps-3" id="product_id" name="product_id" required style="height: 45px;">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stock actuel : {{ $product->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="quantity" class="form-label fw-bold text-secondary">Quantité</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-info">
                                <i class="fas fa-hashtag text-info"></i>
                            </span>
                            <input type="number" class="form-control border-start-0 ps-3" id="quantity" name="quantity" min="1" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="unit_cost" class="form-label fw-bold text-secondary">Coût unitaire ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-info">
                                <i class="fas fa-dollar-sign text-info"></i>
                            </span>
                            <input type="number" class="form-control border-start-0 ps-3" id="unit_cost" name="unit_cost" step="0.01" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-info-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-save me-2"></i>Enregistrer l'achat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-info-gradient {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }

    .bg-light-info {
        background-color: #d1ecf1;
    }

    .btn-info-gradient {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-info-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(23, 162, 184, 0.2);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 0.25rem rgba(23, 162, 184, 0.25);
    }

    .input-group-text {
        border-right: none;
    }

    .border-start-0 {
        border-left: none;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection