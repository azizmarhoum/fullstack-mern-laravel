@extends('layouts.app')

@section('title', 'Ajouter Produit')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-blue-gradient text-white">
            <h3 class="mb-0"><i class="fas fa-cube me-2"></i>Ajouter un Nouveau Produit</h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label fw-bold text-secondary">Nom du Produit</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue-soft">
                                <i class="fas fa-tag text-light-blue"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-3" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="category" class="form-label fw-bold text-secondary">Catégorie</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue-soft">
                                <i class="fas fa-layer-group text-light-blue"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-3" id="category" name="category" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="price" class="form-label fw-bold text-secondary">Prix ($)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue-soft">
                                <i class="fas fa-dollar-sign text-light-blue"></i>
                            </span>
                            <input type="number" step="0.01" class="form-control border-start-0 ps-3" id="price" name="price" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="stock" class="form-label fw-bold text-secondary">Quantité en Stock</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue-soft">
                                <i class="fas fa-boxes text-light-blue"></i>
                            </span>
                            <input type="number" class="form-control border-start-0 ps-3" id="stock" name="stock" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light-blue rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-blue-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-save me-2"></i>Enregistrer Produit
                    </button>
                </div>
            </form>
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

    /* Blue gradient button */
    .btn-blue-gradient {
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--light-blue-dark) 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-blue-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(93, 173, 226, 0.2);
    }

    /* Outline button */
    .btn-outline-light-blue {
        border: 1px solid var(--light-blue);
        color: var(--light-blue);
        transition: all 0.3s ease;
    }

    .btn-outline-light-blue:hover {
        background-color: var(--light-blue-soft);
    }

    /* Input styling */
    .bg-light-blue-soft {
        background-color: var(--light-blue-soft);
        transition: background-color 0.3s ease;
    }

    .input-group:hover .bg-light-blue-soft {
        background-color: rgba(93, 173, 226, 0.2);
    }

    .form-control:focus {
        border-color: var(--light-blue);
        box-shadow: 0 0 0 0.25rem rgba(93, 173, 226, 0.25);
    }

    /* Card styling */
    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Input group tweaks */
    .input-group-text {
        border-right: none;
    }

    .border-start-0 {
        border-left: none;
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection