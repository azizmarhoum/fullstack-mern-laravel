@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<!-- Light blue/white full-height container -->
<div class="container-fluid vh-100 p-0 bg-light">
    <div class="row g-0 h-100">
        <div class="col-12">
            <!-- Card with light theme -->
            <div class="card border-0 h-100 rounded-0 bg-white shadow-sm">
                <!-- Blue gradient header -->
                <div class="card-header bg-blue-gradient text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tachometer-alt fa-lg me-3"></i>
                        <h3 class="mb-0 fw-semibold">Tableau de bord</h3>
                    </div>
                </div>

                <!-- Body with light blue accents -->
                <div class="card-body d-flex flex-column justify-content-center align-items-center p-4 p-md-5 bg-light-blue-soft">
                    <!-- Animated blue icon -->
                    <div class="dashboard-icon mb-4">
                        <div class="icon-wrapper bg-white rounded-circle p-4 d-inline-block border border-light-blue">
                            <i class="fas fa-shopping-cart fa-3x text-light-blue"></i>
                        </div>
                    </div>

                    <!-- Blue text -->
                    <h2 class="text-light-blue mb-3 fw-bold">Bon retour !</h2>
                    <p class="text-muted fs-5 mb-4">Prêt(e) à gérer vos commandes aujourd'hui ?</p>

                    <!-- Blue gradient button -->
                    <a href="{{ route('orders.index') }}" class="btn btn-blue-gradient btn-lg rounded-pill px-4 py-2 fw-semibold mt-3">
                        <i class="fas fa-arrow-right me-2"></i>Accéder aux commandes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --light-blue: #5dade2;
        --light-blue-dark: #3498db;
        --light-blue-soft: #f5f9fc;
    }

    /* Blue gradient header */
    .bg-blue-gradient {
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--light-blue-dark) 100%);
    }

    /* Blue gradient button */
    .btn-blue-gradient {
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--light-blue-dark) 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-blue-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(93, 173, 226, 0.3);
    }

    /* Text colors */
    .text-light-blue {
        color: var(--light-blue-dark);
    }

    .bg-light-blue-soft {
        background-color: var(--light-blue-soft);
    }

    .border-light-blue {
        border-color: var(--light-blue) !important;
    }

    /* Icon animation */
    .icon-wrapper {
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(93, 173, 226, 0.1);
    }

    .dashboard-icon:hover .icon-wrapper {
        transform: scale(1.1);
        box-shadow: 0 5px 20px rgba(93, 173, 226, 0.2);
    }

    /* Card height adjustment */
    .card {
        min-height: calc(100vh - 56px); /* Match navbar height */
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection