<head>
<meta charset="utf-8" />
<title>Projet (à l'aide)</title>
<link rel="stylesheet" href="assets/style.css" />
</head>
<body>
<ul>
	<li><a href="?p=">Accueil</a></li>
	<li><a href="javascript:history.go(-1)">Retour</a></li>
	<?php if (isset($logged) && !empty($logged)){
		$test = new MembersController();
		$test2 = $test->getUserById($_SESSION['id']);
		} else{ ?>
	<li><a href="?p=connect"> Je m'identifie </a></li>
	<li><a href="?p=signup"> Je crée un compte </a></li>
	<?php } ?>
</ul>
<?php if(isset($message[1])) echo $message[1]?>