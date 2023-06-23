<form method="POST">
    <input type="hidden" name="action" value='update_etat'>
    <label for="name">Libéllé:</label>
    <input type="text" name="name" value="<?=$etat->getName() !== null ? $etat->getName() : ''?>">
    <br>
    <label for="description">Description:</label>
    <textarea name="description" ><?=$etat->getDescription() !== null ? $etat->getDescription() : '' ?></textarea>
    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>