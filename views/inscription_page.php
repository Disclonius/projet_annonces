    <h1>Créer un compte</h1>
	<form method="POST">	
	<input type="hidden" name="action" value = "signup">
	<p><input type="text" name="name" id="name" placeholder="Votre nom" required></p>
	<p><input type="text" name="email" id="email" placeholder="Votre adresse email" required></p>
	<p><input type="password" name="pwd" id="pwd" placeholder="Mot de passe" required></p>
	<p><input type="password" name="pwd2" id="pwd2" placeholder="Confirmer le mot de passe" required></p>
	<p><input type="submit" name="connect" id="sent" value="Créer"></p>
	<a href="?p=connect"><p>Vous avez déjà un compte? Cliquez ici pour vous connecter!</p></a>
</form>	
</body>