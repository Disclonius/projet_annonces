<head>
<meta charset="utf-8" />
<title>Projet (à l'aide)</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<ul>
	<li><a href="?p=">Accueil</a></li>
	<li><a href="javascript:history.go(-1)">Retour</a></li>
	<?php if (!empty($logged) && isset($logged)){
		echo "Bonjour ".$_SESSION['user_data']->getUsername()."<br>";
		?>
		<button onclick= "window.location.href = '?p=put_for_sale'">Déposer une annonce</button>
		<button onclick= "window.location.href = '?p=disconnect'">Deconnexion</button>
		<?php } else{ ?>
	<li><a href="?p=connect"> Je m'identifie </a></li>
	<li><a href="?p=signup"> Je crée un compte </a></li>
	<?php } ?>
</ul>
<?php if(isset($message)) echo $message; ?>