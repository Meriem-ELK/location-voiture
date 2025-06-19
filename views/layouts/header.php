
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{ asset }}assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page-container">
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-car"></i>
                <h1>LocAuto</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="{{base}}/" class="{{ currentPage == '' ? 'active' : '' }}"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="{{base}}/clients" class="{{ currentPage == 'clients' ? 'active' : '' }}"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="{{base}}/vehicules" class="{{ currentPage == 'vehicules' ? 'active' : '' }}"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="{{base}}/reservations" class="{{ currentPage == 'reservations' ? 'active' : '' }}"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
