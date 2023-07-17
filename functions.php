<?php

function connect() {
    $hostname = 'localhost';
    $dbname = 'projet_annonces';
    $username = 'root';
    $password = '';
    
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    if(!$conn){
        echo('Erreur : ' .mysqli_connect_error());
    }else
    return $conn;
}

/*function convertDate($i){
  echo htmlentities(date('d M Y', strtotime($i)));
}*/

function getMembers() {
    $db = connect();
    $query = mysqli_query($db, "SELECT * FROM membres");
    if (!$query)
        throw new Exception(mysqli_error($db));
    else
        return mysqli_fetch_all($query,MYSQLI_ASSOC);
}

function getUserByEmail($email) {
    try {
        $db = connect();
        $query=$db->prepare("SELECT * FROM membres WHERE email= ?");
        $query->execute(["email"=>$email]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
}   

function addUser() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    if(!getUserByEmail($email)){
        if ($_POST['pwd1']===$_POST['pwd2']){
            if(preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd1'])){
                $pwd=password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
                $nom=htmlspecialchars($_POST['nom']);
                $token=bin2hex(random_bytes(16));
                try {
                    $db = connect();
                    $query=$db->prepare('INSERT INTO membres (is_admin, email, username, hash, token, date_inscription) VALUES (0, :email, :nom, :pwd, :token, :date)');
                    $query->execute(['email'=> $email, 'username'=> $nom, 'hash'=> $pwd, 'token'=> $token, 'date' => date('Y-m-d')]);
                    if ($query->rowCount()){
                        $content="<p><a href='authentification?p=activation&t=$token'>Merci de cliquer sur ce lien pour activer votre compte</a></p>"; //changer ligne
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );
                        mail($email,"Veuillez activer votre compte", $content, $headers);
                        return array("success", "Inscription réussi. Vous allez recevoir un mail pour activer votre compte");
                    }else return array("error", "Problème lors de enregistrement");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else array("error", "Les 2 saisies de mot de passes doivent être identique.");
    }else array("error", "Un compte existe déjà pour cet email.");
}