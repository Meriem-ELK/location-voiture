<!-- Header -->
{{ include('layouts/header.php', {title: 'Modifier un Client'})}}

        <div class="page-header">
            <h2>Modifier un Client</h2>
            <div class="actions">
                <a href="{{base}}/client/show?id={{client.id}}" class="btn"><i class="fas fa-arrow-left"></i> Retour aux détails</a>
            </div>
        </div>

        <section class="form-container">

        <h3>Informations du client</h3>

            <!-- Gestion des erreurs -->
            {% if errors is defined %}
            <div class="error">
                <ul>
                    {% for error in errors %}
                        <li>{{ error }}</li>
                    {% endfor %}
                </ul>
            </div>
            {% endif %}
            
        <form method="post">
            <div class="form-group">
                <label>Nom *
                    <input type="text" name="nom" value="{{client.nom}}">
                </label>
            </div>

            <div class="form-group">
                <label>Prénom *
                    <input type="text" name="prenom" value="{{client.prenom}}">
                </label>
            </div>

            <div class="form-group">
                <label>Adresse
                    <textarea name="adresse" rows="3">{{client.adresse}}</textarea>
                </label>
            </div>

            <div class="form-group">
                <label>Email *
                    <input type="email" name="email" value="{{client.email}}">
                </label>
            </div>

            <div class="form-group">
                <label>Téléphone *
                    <input type="tel" name="telephone" value="{{client.telephone}}">
                </label>
            </div>

            <div class="form-group">
                <label>Numéro de permis de conduire *
                    <input type="text" name="permis_conduire" value="{{client.permis_conduire}}">
                </label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn add"><i class="fas fa-save"></i> Enregistrer les modifications</button>
                <a href="{{base}}/clients" class="btn cancel">Annuler</a>
            </div>
        </form>
  
<!-- Footer -->
{{ include('layouts/footer.php')}}