@extends('layouts.app')

@section('title', 'Modifier Produit')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-primary-gradient text-white">
            <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier Produit</h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label fw-bold text-secondary">Nom du Produit</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue">
                                <i class="fas fa-tag text-primary"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-3" id="name" name="name"
                                value="{{ $product->name }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="category" class="form-label fw-bold text-secondary">Catégorie</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue">
                                <i class="fas fa-layer-group text-primary"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-3" id="category" name="category"
                                value="{{ $product->category }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="price" class="form-label fw-bold text-secondary">Prix ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue">
                                <i class="fas fa-dollar-sign text-primary"></i>
                            </span>
                            <input type="number" step="0.01" class="form-control border-start-0 ps-3" id="price" name="price"
                                value="{{ $product->price }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="stock" class="form-label fw-bold text-secondary">Quantité en Stock</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue">
                                <i class="fas fa-boxes text-primary"></i>
                            </span>
                            <input type="number" class="form-control border-start-0 ps-3" id="stock" name="stock"
                                value="{{ $product->stock }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-save me-2"></i>Mettre à Jour Produit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-primary-gradient {
        background: linear-gradient(135deg, #4da6ff 0%, #0066cc 100%);
    }

    .bg-light-blue {
        background-color: #e6f2ff;
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #4da6ff 0%, #0066cc 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 102, 204, 0.2);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }

    .form-control:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 166, 255, 0.25);
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