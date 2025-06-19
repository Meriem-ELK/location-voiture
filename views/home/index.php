{{ include('layouts/header.php', {title: 'Accueil - LocAuto'})}}
        <div class="page-header">
            <h2>Tableau de bord</h2>
            <div class="actions">
                <a href="{{base}}/reservations/create" class="btn add"><i class="fas fa-plus"></i> Nouvelle réservation</a>
            </div>
        </div>

        <section class="dashboard">
            <div class="dashboard-item">
                <div class="stats-icon clients">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-info">
                    <h3>Clients</h3>
                    <p class="stats-number">{{ stats.total_clients }}</p>
                    <a href="{{base}}/clients" class="stats-link">Voir tous les clients <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="dashboard-item">
                <div class="stats-icon vehicles">
                    <i class="fas fa-car-side"></i>
                </div>
                <div class="stats-info">
                    <h3>Véhicules</h3>
                    <p class="stats-number">{{ stats.total_vehicules }}</p>
                    <p class="stats-detail">{{ stats.vehicules_disponibles }} disponibles</p>
                    <a href="{{base}}/vehicules" class="stats-link">Voir tous les véhicules <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="dashboard-item">
                <div class="stats-icon reservations">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stats-info">
                    <h3>Réservations</h3>
                    <p class="stats-number">{{ stats.total_reservations }}</p>
                    <a href="{{base}}/reservations" class="stats-link">Voir toutes les réservations <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <section class="quick-actions">
            <h2>Actions rapides</h2>
            <div class="actions-grid">
                <a href="{{base}}/client/create" class="action-card">
                    <i class="fas fa-user-plus"></i>
                    <span>Ajouter un client</span>
                </a>
                <a href="{{base}}/vehicule/create" class="action-card">
                    <i class="fas fa-car-alt"></i>
                    <span>Ajouter un véhicule</span>
                </a>
                <a href="{{base}}/reservations/create" class="action-card">
                    <i class="fas fa-calendar-plus"></i>
                    <span>Nouvelle réservation</span>
                </a>
            </div>
        </section>
  {{ include('layouts/footer.php')}}