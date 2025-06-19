{{ include('layouts/header.php', {title: 'Liste des véhicules'})}}

<div class="vehicules-list">
    <h2>Liste des Véhicules</h2>
</div>

<table>
    <thead>
        <tr>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Année</th>
            <th>Immatriculation</th>
            <th>Catégorie</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        {% for vehicule in vehicules %}
            <tr>
                <td>{{ vehicule.marque }}</td>
                <td>{{ vehicule.modele }}</td>
                <td>{{ vehicule.annee }}</td>
                <td>{{ vehicule.immatriculation }}</td>
                <td>{{ vehicule.categorie_nom }}</td>
                <td>
                    {% if vehicule.disponible %}
                        <span class="badge badge-disponible">Disponible</span>
                    {% else %}
                        <span class="badge badge-indisponible">Indisponible</span>
                    {% endif %}
                </td>
                <td class="actions">
                    <a href="{{base}}/vehicule/show?id={{vehicule.id}}" class="btn view">Voir</a>
                    <a href="{{base}}/vehicule/edit?id={{vehicule.id}}" class="btn edit">Modifier</a>
                    <form action="{{base}}/vehicule/delete" method="post" style="display: inline;" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">
                        <input type="hidden" name="id" value="{{vehicule.id}}">
                        <button type="submit" class="btn delete">Supprimer</button>
                    </form>
                </td>
            </tr>
        {% endfor %}
    </tbody>
</table>

<a href="{{base}}/vehicule/create" class="btn add">Ajouter un véhicule</a>

{{ include('layouts/footer.php')}}