@extends('layouts.app')

@section('title', 'Ajouter Client')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-blue-gradient text-white">
            <h3 class="mb-0"><i class="fas fa-user-plus me-2"></i>Ajouter un Nouveau Client</h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label fw-bold text-secondary">Nom Complet</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-blue-soft">
                            <i class="fas fa-user text-light-blue"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-3" id="name" name="name"
                            required style="height: 45px;">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label fw-bold text-secondary">Numéro de Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-blue-soft">
                            <i class="fas fa-phone text-light-blue"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-3" id="phone" name="phone"
                            required style="height: 45px;">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-blue-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-save me-2"></i>Créer Client
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

    /* Input styling */
    .bg-light-blue-soft {
        background-color: var(--light-blue-soft);
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
        transition: background-color 0.3s ease;
    }

    .input-group:hover .input-group-text {
        background-color: rgba(93, 173, 226, 0.2);
    }

    .border-start-0 {
        border-left: none;
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection