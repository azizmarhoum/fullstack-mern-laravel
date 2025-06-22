<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --light-blue: #5dade2;
            --light-blue-dark: #3498db;
            --light-blue-soft: #ebf5fb;
            --white: #ffffff;
            --sidebar-width: 250px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--white);
            color: #333;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            margin: 0;
            padding: 0;
        }

        .sidebar-brand {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--light-blue), var(--light-blue-dark));
            color: var(--white);
            font-weight: 700;
            font-size: 1.3rem;
            text-align: center;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .nav-link {
            color: #555;
            padding: 0.8rem 1.5rem;
            margin: 0.2rem 0;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--light-blue-dark);
            background: rgba(93, 173, 226, 0.1);
            border-left: 3px solid var(--light-blue);
            transform: translateX(5px);
        }

        .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 10px;
            color: var(--light-blue);
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            background-color: #f8f9fa;
            width: calc(100% - var(--sidebar-width));
        }

        /* Account Dropdown */
        .account-dropdown {
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu {
            background-color: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #555;
            padding: 0.5rem 1.5rem;
        }

        .dropdown-item:hover {
            background-color: rgba(93, 173, 226, 0.1);
            color: var(--light-blue-dark);
        }

        /* Responsive Toggle */
        @media (max-width: 992px) {
            .sidebar {
                left: -var(--sidebar-width);
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-toggle {
                display: block !important;
            }
        }

        /* Toggle Button */
        .sidebar-toggle {
            position: fixed;
            left: 10px;
            top: 10px;
            z-index: 999;
            display: none;
            background: var(--light-blue);
            color: var(--white);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <!-- Sidebar Toggle Button (Mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Light Blue/White Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-boxes me-2"></i>Gestion de Stock
        </div>

        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">
                        <i class="fas fa-users"></i> Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="fas fa-box-open"></i> Produits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">
                        <i class="fas fa-shopping-cart"></i> Commandes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('purchases.index') }}">
                        <i class="fas fa-truck"></i> Achats
                    </a>
                </li>
            </ul>
        </div>


    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar on Mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Highlight active link
        const currentUrl = window.location.href;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>