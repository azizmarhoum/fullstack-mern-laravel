@extends('layouts.app')

@section('title', 'Créer Commande')
@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary-gradient text-white">
            <h3 class="mb-0"><i class="fas fa-cart-plus me-2"></i>Créer une Nouvelle Commande</h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('orders.store') }}" method="POST" id="order-form">
                @csrf

                <div class="mb-4">
                    <label for="client_id" class="form-label fw-bold text-secondary">Client</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-blue">
                            <i class="fas fa-user text-primary"></i>
                        </span>
                        <select class="form-select border-start-0 ps-3" name="client_id" required style="height: 45px;">
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Produits</label>
                    <div id="product-list" class="mb-3">
                        <!-- Dynamic rows will appear here -->
                    </div>
                    <button type="button" id="add-product" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter Produit
                    </button>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary-gradient px-4 py-2 rounded-pill">
                        <i class="fas fa-paper-plane me-2"></i>Passer la Commande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add initial product row
        addProductRow();

        // Add product row dynamically
        document.getElementById('add-product').addEventListener('click', addProductRow);

        // Remove product row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('.product-row').remove();
            }
        });

        // Form validation
        document.getElementById('order-form').addEventListener('submit', function(e) {
            const productRows = document.querySelectorAll('#product-list .product-row');
            if (productRows.length === 0) {
                e.preventDefault();
                showAlert('danger', 'Veuillez ajouter au moins un produit !');
            }
        });
    });

    function addProductRow() {
        const productList = document.getElementById('product-list');
        const row = document.createElement('div');
        row.className = 'product-row row mb-3 p-3 bg-light rounded';
        row.innerHTML = `
            <div class="col-md-6 mb-2 mb-md-0">
                <select class="form-select" name="products[id][]" required>
                    <option value="">Sélectionner un Produit</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-stock="{{ $product->stock }}">
                            {{ $product->name }} (Stock : {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <input type="number" class="form-control quantity-input" 
                       name="products[quantity][]" placeholder="Quantité" min="1" required>
            </div>
            <div class="col-md-3 text-md-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-product">
                    <i class="fas fa-trash-alt me-1"></i>Supprimer
                </button>
            </div>
        `;
        productList.appendChild(row);

        // Add stock validation
        const select = row.querySelector('select');
        const quantityInput = row.querySelector('.quantity-input');

        select.addEventListener('change', function() {
            const maxStock = this.options[this.selectedIndex]?.dataset.stock || 0;
            quantityInput.max = maxStock;
            quantityInput.title = `Max disponible : ${maxStock}`;
        });

        quantityInput.addEventListener('input', function() {
            const maxStock = select.options[select.selectedIndex]?.dataset.stock || 0;
            if (parseInt(this.value) > parseInt(maxStock)) {
                this.setCustomValidity(`Seulement ${maxStock} disponible(s) en stock`);
                showAlert('warning', `Seulement ${maxStock} disponible(s) en stock pour le produit sélectionné`);
            } else {
                this.setCustomValidity('');
            }
        });
    }

    function showAlert(type, message) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.role = 'alert';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const container = document.querySelector('.card-body');
        container.insertBefore(alert, container.firstChild);

        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    }
</script>

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

    .form-select:focus,
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

    .product-row {
        transition: all 0.3s ease;
    }

    .product-row:hover {
        background-color: rgba(77, 166, 255, 0.1) !important;
    }
</style>
@endsection