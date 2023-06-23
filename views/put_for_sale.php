<form method="POST">
    <input type="hidden" name="action" value='put_for_sale'>
    <label for="title">Titre de l'annonce:</label>
    <input type="text" name="title" id="title">
    <br>
    <label for="description">Description de votre annonce:</label>
    <textarea name="description"></textarea>
    <br>
    <label for="price">Prix de l'annonce:</label>
    <input type="number" name="price">
    <br>
    <label for="etat">Etat:</label>
    <select name="etat">
        <option value="">Choisir</option>
        <option value="neuf">Neuf</option>
        <option value="meh">Moyen</option>
        <option value="nul">Claqué au sol</option>
    </select>
    <br>
    <select name="categorie">
    </select>
    <label for="duration">Durée de l'annonce:</label>
    <select name="duration">
        <option value="">Choisir</option>
        <option value="une_semaine">7 jours</option>
        <option value="deux_semaines">14 jours</option>
        <option value="un_mois">30 jours</option>
    </select>
    <br>
    <label>Photos:</label>
    <input type="file" name="file[]" accept="image/jpeg, image/png" multiple>
    <br>
    <button type="submit">Publier l'annonce</button>
</form>
