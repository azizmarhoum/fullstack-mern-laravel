@extends('layouts.app')

@section('title', 'Order Details')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary-gradient text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-receipt me-2"></i>Commande #{{ $order->id }}
                    <span class="badge bg-light text-dark ms-2">
                        {{ ucfirst($order->status) }}
                    </span>
                </h3>
                <a href="{{ route('orders.index') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-none bg-light-blue">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-user-circle me-2"></i>Informations du client
                            </h5>
                            <p class="mb-1"><strong>Nom :</strong> {{ $order->client->name }}</p>
                            <p class="mb-1"><strong>Téléphone :</strong> {{ $order->client->phone }}</p>
                            <p class="mb-0"><strong>Email :</strong> {{ $order->client->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-none bg-light-blue">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-calendar-alt me-2"></i>Détails de la commande
                            </h5>
                            <p class="mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</p>
                            <p class="mb-1"><strong>Statut :</strong>
                                @php
                                $statusColors = [
                                'pending' => 'warning',
                                'confirmed' => 'success',
                                'cancelled' => 'danger',
                                'shipped' => 'info',
                                'delivered' => 'primary'
                                ];
                                @endphp
                                <span class="badge rounded-pill bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p class="mb-0"><strong>Articles :</strong> {{ $order->products->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mb-3 text-primary">
                <i class="fas fa-boxes me-2"></i>Articles commandés
            </h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light-blue">
                        <tr>
                            <th class="ps-4">Produit</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th class="text-end pe-4">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->products as $product)
                        <tr class="border-bottom border-light">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-soft-blue rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                    {{ $product->name }}
                                </div>
                            </td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ number_format($product->pivot->unit_price, 2) }} $</td>
                            <td class="text-end pe-4 fw-bold">{{ number_format($product->pivot->total_price, 2) }} $</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="{{ route('orders.pdf', $order->id) }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-file-pdf me-2"></i>Télécharger PDF
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-none bg-primary text-white">
                        <div class="card-body text-end">
                            <h4 class="mb-0">Total général</h4>
                            <h2 class="mb-0">{{ number_format($order->total_price, 2) }} $</h2>
                        </div>
                    </div>
                </div>
            </div>
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

    .bg-soft-blue {
        background-color: #b3d7ff;
    }

    .avatar-sm {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }

    .card {
        border-radius: 12px;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(77, 166, 255, 0.05);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection