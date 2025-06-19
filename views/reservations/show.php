{{ include('layouts/header.php', {title: 'Détails de la réservation'})}}

    <div class="page-header">
            <h2>Détails de la Réservation</h2>
            <div class="actions">
                <a href="{{base}}/reservations/edit" class="btn edit"><i class="fas fa-edit"></i> Modifier</a>
                <a href="{{base}}/reservations" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>
    </div>

    <section class="details-section">
            
    <div class="details-card">
                    <div class="details-header">
                        <h3>Informations</h3>
                    </div>


                    <div class="details-content">
                        <h4>Informations du Client</h4>
                        <div class="details-item">
                            <span class="label"><i class="fas fa-user"></i> Nom complet:</span>
                            <span class="value">
                            </span>
                        </div>
                    </div>


                    <div class="reservation-summary">
                        <div class="summary-box">
                            <h4>Date de début</h4>
                            <p><i class="fas fa-calendar-day"></i></p>
                        </div>
                        <div class="summary-box">
                            <h4>Date de fin</h4>
                            <p><i class="fas fa-calendar-day"></i> </p>
                        </div>
                        <div class="summary-box">
                            <h4>Durée</h4>
                            <p><i class="fas fa-clock"></i></p>
                        </div>
                        <div class="summary-box">
                            <h4>Prix Total</h4>
                            <p class="price-tag"> $</p>
                        </div>
                        <div class="summary-box">
                            <h4>Statut</h4>
                            <span class="status-badge"></span>
                        </div>
                </div>

                <div class="details-content">
                    <h4>Informations du Véhicule</h4>
                    <div class="details-item">
                        <span class="label"><i class="fas fa-car"></i> Véhicule:</span>
                        <span class="value"></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-tag"></i> Immatriculation:</span>
                        <span class="value"></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-list"></i> Catégorie:</span>
                        <span class="value"></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-euro-sign"></i> Tarif journalier:</span>
                        <span class="value">$</span>
                    </div>
                </div>

       
                <div class="details-content">
                    <h4>Détails de la Réservation</h4>
                    <div class="details-item">
                        <span class="label"><i class="fas fa-hashtag"></i> Numéro de réservation:</span>
                        <span class="value"></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-calculator"></i> Calcul du prix:</span>
                        <span class="value"></span>
                    </div>
                </div>

                 </div>
           
        </section>

        <div class="actions-bottom">
            <a href="{{base}}/reservations/edit" class="btn edit"><i class="fas fa-edit"></i> Modifier la réservation</a>

        </div>

    </div>

    </section>

{{ include('layouts/footer.php')}}