<!-- Header -->
{{ include('layouts/header.php', {title: 'Liste de réservations'})}}

    <div><h2>Liste des Réservations</h2></div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>N° Réservation</th>
                    <th>Client</th>
                    <th>Véhicule</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Prix Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% if reservations is empty %}
                    <tr>
                        <td colspan="8" class="text-center">Aucune réservation trouvée</td>
                    </tr>
                {% else %}
                    {% for reservation in reservations %}
                        <tr>
                            <td>#{{ reservation.id }}</td>
                            <td>{{ reservation.client_nom|e }}</td>
                            <td>
                                <div class="vehicle-info">
                                    <strong>{{ reservation.vehicule_nom|e }}</strong>
                                    <small>{{ reservation.immatriculation|e }}</small>
                                </div>
                            </td>
                            <td>{{ reservation.date_debut|date('d/m/Y') }}</td>
                            <td>{{ reservation.date_fin|date('d/m/Y') }}</td>
                            <td class="prix">{{ reservation.prix_total|number_format(2, '.', ' ') }} $</td>
                            <td>
                                <span class="status status-{{ reservation.statut|replace({' ': '-'})|lower }}">
                                    {{ reservation.statut|capitalize }}
                                </span>
                            </td>
                            <td class="actions">
                                <a href="{{base}}/reservations/show?id={{reservation.id}}" class="btn view" title="Voir">
                                   Voir
                                </a>
                                <a href="{{base}}/reservations/edit?id={{reservation.id}}" class="btn edit">Modifier
                                </a>
                                  <form action="{{base}}/reservations/delete" method="post" style="display: inline;" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                        <input type="hidden" name="id" value="{{reservation.id}}">
                        <button type="submit" class="btn delete">Supprimer</button>
                    </form>
                            </td>
                        </tr>
                    {% endfor %}
                {% endif %}
            </tbody>
        </table>

    <a href="{{base}}/reservations/create" class="btn add">Nouvelle Réservation</a>

    {{ include('layouts/footer.php')}}