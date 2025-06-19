{{ include('layouts/header.php', {title: 'Détails de la réservation'})}}

        <div class="page-header">
            <div class="actions">
                <a href="{{base}}/reservations" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>
        <section class="form-control">
            <h2>Nouvelle Réservation</h2>
            
            <form action="reservation-ajouter.php" method="post">
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select id="client_id" name="client_id" required>
                        <option value="">Sélectionner un client</option>
                        <option value=""></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="vehicule_id">Véhicule</label>
                    <select id="vehicule_id" name="vehicule_id" required>
                        <option value="">Sélectionner un véhicule</option>
                        <option value=""></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="date_debut">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" required>
                </div>
                
                <div class="form-group">
                    <label for="date_fin">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" required>
                </div>
                
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select id="statut" name="statut" required>
                        <option value="en attente">En attente</option>
                        <option value="confirmée">Confirmée</option>
                        <option value="annulée">Annulée</option>
                        <option value="terminée">Terminée</option>
                    </select>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn add"><i class="fas fa-save"></i> Enregistrer</button>
                    <a href="{{base}}/reservations" class="btn cancel"><i class="fas fa-times"></i> Annuler</a>
                </div>
            </form>
        </section>

{{ include('layouts/footer.php')}}