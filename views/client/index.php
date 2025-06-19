{{ include('layouts/header.php', {title: 'Détails du client'})}}


    <div class="clients-list">
        <h2>Liste des Clients</h2>
    </div>



        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               {% for client in clients %}

                    <tr>
                        <td>{{ client.nom }} </td>
                        <td>{{ client.prenom }}</td>
                        <td>{{ client.email }}</td>
                        <td>{{ client.telephone }}</td>
                        <td class="actions">
                            <a href="{{base}}/client/show?id={{client.id}}" class="btn view">Voir</a>
                            <a href="{{base}}/client/edit?id={{client.id}}" class="btn edit">Modifier</a>
                            <form action="{{base}}/client/delete" method="post" style="display: inline;" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                <input type="hidden" name="id" value="{{client.id}}">
                                <button type="submit" class="btn delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                 {% endfor %}
            </tbody>
        </table>
   

        <a href="{{base}}/client/create" class="btn add">Ajouter un client</a>


{{ include('layouts/footer.php')}}