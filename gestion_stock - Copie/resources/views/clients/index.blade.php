@extends('layouts.app')

@section('title', 'Clients')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary-gradient text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-users me-2"></i>Gestion des Clients</h3>
                <a href="{{ route('clients.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Ajouter Client
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-blue">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-bottom border-light">
                            <td class="ps-4 fw-bold text-primary">{{ $client->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-soft-blue rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    {{ $client->name }}
                                </div>
                            </td>
                            <td><span class="badge bg-light-blue text-dark">{{ $client->phone }}</span></td>
                            <td class="text-end pe-4">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-soft-warning rounded-start-pill px-3">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
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
    .bg-primary-gradient {
        background: linear-gradient(135deg, #4da6ff 0%, #0066cc 100%);
    }

    .bg-light-blue {
        background-color: #e6f2ff;
    }

    .bg-soft-blue {
        background-color: #b3d7ff;
    }

    .text-soft-blue {
        color: #b3d7ff;
    }

    .btn-soft-warning {
        background-color: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
    }

    .btn-soft-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
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
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection