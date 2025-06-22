<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture Commande #{{ $order->id }}</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .invoice-meta {
            text-align: right;
            color: #7f8c8d;
        }

        .invoice-number {
            font-size: 18px;
            font-weight: bold;
            color: #3498db;
        }

        .invoice-status {
            display: inline-block;
            padding: 3px 10px;
            background-color: #f1c40f;
            color: #fff;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Sections */
        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #3498db;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        /* Client Info */
        .client-info {
            display: flex;
            justify-content: space-between;
        }

        .info-block {
            width: 48%;
        }

        .info-label {
            font-weight: bold;
            color: #7f8c8d;
            display: inline-block;
            width: 100px;
        }

        /* Table Styles */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .invoice-table th {
            background-color: #3498db;
            color: white;
            text-align: left;
            padding: 10px;
            font-weight: bold;
        }

        .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Total */
        .invoice-total {
            text-align: right;
            margin-top: 20px;
            font-size: 16px;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #3498db;
        }

        /* Status Colors */
        .status-pending {
            background-color: #f39c12;
        }

        .status-confirmed {
            background-color: #2ecc71;
        }

        .status-cancelled {
            background-color: #e74c3c;
        }

        .status-shipped {
            background-color: #3498db;
        }

        .status-delivered {
            background-color: #9b59b6;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <div>
            <div class="invoice-title">Facture</div>
            <div>Date: {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</div>
        </div>
        <div class="invoice-meta">
            <div class="invoice-number">Commande #{{ $order->id }}</div>
            <div class="invoice-status status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </div>
        </div>
    </div>

    <div class="client-info section">
        <div class="info-block">
            <div class="section-title">Client</div>
            <div><span class="info-label">Nom:</span> {{ $order->client->name }}</div>
            <div><span class="info-label">Téléphone:</span> {{ $order->client->phone }}</div>
        </div>
        <div class="info-block">
            <div class="section-title">Détails</div>
            <div><span class="info-label">Articles:</span> {{ $order->products->count() }}</div>
            <div><span class="info-label">Référence:</span> CMD-{{ $order->id }}-{{ date('Y', strtotime($order->order_date)) }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Articles</div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->unit_price, 2) }} €</td>
                    <td>{{ number_format($product->pivot->total_price, 2) }} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="invoice-total">
        <div>Total HT: {{ number_format($order->total_price, 2) }} €</div>
        <div>TVA (0%): 0,00 €</div>
        <div class="total-amount">Total TTC: {{ number_format($order->total_price, 2) }} €</div>
    </div>
</body>

</html>