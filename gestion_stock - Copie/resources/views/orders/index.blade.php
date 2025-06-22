@extends('layouts.app')

@section('title', 'Commandes')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary-gradient text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Gestion des Commandes</h3>
                <a href="{{ route('orders.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Ajouter Commande
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3">
                    <form method="GET" action="{{ route('orders.index') }}">
                        <div class="input-group">
                            <span class="input-group-text bg-light-blue">
                                <i class="fas fa-filter text-primary"></i>
                            </span>
                            <select name="status" class="form-select border-start-0" onchange="this.form.submit()">
                                <option value="">Tous les Statuts</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Livrée</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light-blue">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-bottom border-light">
                            <td class="ps-4 fw-bold text-primary">#{{ $order->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-soft-blue rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    {{ $order->client->name }}
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</td>
                            <td>
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
                            </td>
                            <td class="fw-bold">${{ number_format($order->total_price, 2) }}</td>
                            <td class="text-end pe-4">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-soft-info rounded-start-pill px-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-soft-warning rounded-end-pill px-3">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
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
    .bg-primary-gradient {
        background: linear-gradient(135deg, #4da6ff 0%, #0066cc 100%);
    }

    .bg-light-blue {
        background-color: #e6f2ff;
    }

    .bg-soft-blue {
        background-color: #b3d7ff;
    }

    .btn-soft-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
    }

    .btn-soft-warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
    }

    .avatar-sm {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .rounded-pill {
        border-radius: 50px !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(77, 166, 255, 0.05);
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection