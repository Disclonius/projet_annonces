<form method="POST">
    <input type="hidden" name="action" value='update_member'>
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" name="username" value="<?=$member->getUsername() !== null ? htmlentities($member->getUsername()) : ''?>">
    <br>
    <label for="email">Adresse e-mail:</label>
    <input type="email" name="email" value="<?=$member->getEmail() !== null ? htmlentities($member->getEmail()) : '' ?>">
    <br>
    <label for="firstname">Prénom:</label>
    <input type="text" name="firstname" value="<?=$member->getFirstname() !== null ? htmlentities($member->getFirstname()) : ''?>">
    <br>
    <label for="lastname">Nom:</label>
    <input type="text" name="lastname" value="<?=$member->getLastname() !== null ? htmlentities($member->getLastname()) : ''?>">
    <br>
    <label for="birthdate">Date de naissance:</label>
    <input type="date" name="birthdate" value="<?=$member->getBirthdate() !== null ? htmlentities($member->getBirthdate()) : ''?>">
    <br>
    <label for="phone">Numéro de téléphone:</label>
    <input type="text" name="phone" value="<?=$member->getPhone_number() !== null ? htmlentities($member->getPhone_number()) : ''?>">
    <br>
    <label for="address">Adresse postale:</label>
    <input type="text" name="address" value="<?=$member->getAdress() !== null ? htmlentities($member->getAdress()) : ''?>">
    <br>
    <label for="zipcode">Code postal:</label>
    <input type="text" name="zipcode" value="<?=$member->getZip_code() !== null ? htmlentities($member->getZip_code()) : ''?>">
    <br>
    <label for="city">Ville:</label>
    <input type="text" name="city" value="<?=$member->getTown() !== null ? htmlentities($member->getTown()) : ''?>">
    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>