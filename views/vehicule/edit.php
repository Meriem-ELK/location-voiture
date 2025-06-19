{{ include('layouts/header.php', {title: 'Modifier un véhicule'})}}

<div class="page-header">
    <h2>Modifier un Véhicule</h2>
    <div class="actions">
        <a href="{{base}}/vehicule/show?id={{vehicule.id}}" class="btn"><i class="fas fa-arrow-left"></i> Retour aux détails</a>
    </div>
</div>

<section class="form-container">
    <h3>Informations du véhicule</h3>

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
            <label>Marque *
                <input type="text" name="marque" value="{{vehicule.marque}}">
            </label>
        </div>

        <div class="form-group">
            <label>Modèle *
                <input type="text" name="modele" value="{{vehicule.modele}}">
            </label>
        </div>

        <div class="form-group">
            <label>Année *
                <input type="number" name="annee" min="1900" max="2025" value="{{vehicule.annee}}">
            </label>
        </div>

        <div class="form-group">
            <label>Immatriculation *
                <input type="text" name="immatriculation" value="{{vehicule.immatriculation}}">
            </label>
        </div>

        <div class="form-group">
            <label>Couleur
                <input type="text" name="couleur" value="{{vehicule.couleur}}">
            </label>

        <div class="form-group">
            <label>Kilométrage *
                <input type="number" name="kilometrage" min="0" value="{{vehicule.kilometrage}}">
            </label>
        </div>

        <div class="form-group">
            <label>Catégorie *
                <select name="categorie_id">
                    <option value="">Sélectionner une catégorie</option>
                    {% for categorie in categories %}
                        <option value="{{categorie.id}}" 
                                {% if vehicule.categorie_id == categorie.id %}selected{% endif %}>
                            {{categorie.nom}} - {{categorie.tarif_journalier}}€/jour
                        </option>
                    {% endfor %}
                </select>
            </label>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="disponible" value="1" 
                       {% if vehicule.disponible %}checked{% endif %}>
                Véhicule disponible
            </label>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn add"><i class="fas fa-save"></i> Enregistrer les modifications</button>
            <a href="{{base}}/vehicules" class="btn cancel">Annuler</a>
        </div>
    </form>
</section>

{{ include('layouts/footer.php')}}
