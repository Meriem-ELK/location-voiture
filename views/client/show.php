{{ include('layouts/header.php', {title: 'Détails du client'})}}
<div class="page-header">
    <h2>Détails du Client</h2>
    <div class="actions">
        <a href="{{base}}/client/edit?id={{client.id}}" class="btn edit"><i class="fas fa-edit"></i> Modifier</a>
        <a href="{{base}}/clients" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
<div class="client-details">
    <div class="details-card">
        <div class="details-header">
            <span class="value">{{ client.nom ~ ' ' ~ client.prenom }}</span>
        </div>
        <div class="details-content">
            <div class="details-item">
                <span class="label"><i class="fas fa-envelope"></i> Email :</span>
                <span class="value">{{ client.email }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-phone"></i> Téléphone :</span>
                <span class="value">{{ client.telephone }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-map-marker-alt"></i> Adresse :</span>
                <span class="value">{{ client.adresse }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-id-card"></i> Numéro de permis :</span>
                <span class="value">{{ client.permis_conduire }}</span>
            </div>
            <div class="details-item">
                <span class="label"><i class="fas fa-calendar-alt"></i> Date d'inscription :</span>
                <span class="value">{{ client.date_inscription }}</span>
            </div>
        </div>
    </div>
</div>
{{ include('layouts/footer.php')}}