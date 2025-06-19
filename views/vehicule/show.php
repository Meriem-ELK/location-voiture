{{ include('layouts/header.php', {title: 'Détails du véhicule'})}}

<div class="page-header">
    <h2>Détails du Véhicule</h2>
    <div class="actions">
        <a href="{{base}}/vehicule/edit?id={{vehicule.id}}" class="btn edit"><i class="fas fa-edit"></i> Modifier</a>
        <a href="{{base}}/vehicules" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
    </div>
</div>

<div class="vehicule-details">
    <div class="details-card">
        <div class="details-header">
            <h3>{{ vehicule.marque ~ ' ' ~ vehicule.modele }}</h3>
            {% if vehicule.disponible %}
                <span class="badge badge-disponible">Disponible</span>
            {% else %}
                <span class="badge badge-indisponible">Indisponible</span>
            {% endif %}
        </div>
        <div class="details-content">
            <div class="details-item">
                <span class="label"><i class="fas fa-car"></i> Marque :</span>
                <span class="value">{{ vehicule.marque }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-car-side"></i> Modèle :</span>
                <span class="value">{{ vehicule.modele }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-calendar-alt"></i> Année :</span>
                <span class="value">{{ vehicule.annee }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-id-card"></i> Immatriculation :</span>
                <span class="value">{{ vehicule.immatriculation }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-palette"></i> Couleur :</span>
                <span class="value">{{ vehicule.couleur }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-road"></i> Kilométrage :</span>
                <span class="value">{{ vehicule.kilometrage }} km</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-tags"></i> Catégorie :</span>
                <span class="value">{{ vehicule.categorie_nom }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-euro-sign"></i> Tarif journalier :</span>
                <span class="value">{{ vehicule.tarif_journalier }} €</span>
            </div>
        </div>
    </div>
</div>

{{ include('layouts/footer.php')}}