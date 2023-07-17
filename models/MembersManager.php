<?php
require_once "Model.php";
require_once "Member.php";

class MembersManager extends Model {

    public function getUserByEmail($email) {
        try {
            $req = $this->getDatabase()->prepare('SELECT * FROM membres WHERE email= :email');
            $req->execute(['email'=>$email]);
            if ($req->rowCount()){
                return $req->fetch();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
        return false;
    }

    function getUserById($id) {
        try {
            $req = $this->getDatabase()->prepare('SELECT * FROM membres WHERE id_membre= :id');
            $req->execute(['id' => $id]);
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
        return false;
    }

    public function getAllMembers() {
        $list = [];
        $req = $this->getDatabase()->prepare("SELECT * FROM membres");
        $req->execute();
        $members = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor(); 

        foreach($members as $member){
            $newMember = new Member(
                $member['id_membre'],
                $member['is_admin'],
                $member['username'],
                $member['email'],
                $member['hash'],
                $member['prenom'],
                $member['nom'],
                $member['date_naissance'],
                $member['num_telephone'],
                $member['adresse_postale'],
                $member['code_postal'],
                $member['ville'],
                $member['date_inscription'],
                $member['token'],
                $member['date_validite_token'],
                $member['solde_cagnotte']
            );
            array_push($list, $newMember);
        }
        return $list;
    }

    function registerUser()
    {
        if (!empty($email)) {
            $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
            if (!empty($email) && !$this->getUserByEmail($email)) {
                if ($_POST['pwd'] === $_POST['pwd2']) {
                    if (preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])) {
                        $hashedPassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                        $username = htmlspecialchars($_POST['name']);
                        $token = bin2hex(random_bytes(16));
                        try {
                            $date_ins = date('Y-m-d H:i:s');
                            $date_perim = date('Y-m-d H:i:s', strtotime('+2 hours', strtotime($date_ins)));
                            $req = $this->getDatabase()->prepare('INSERT INTO membres (username, email, hash, date_inscription, token, date_validite_token) VALUES (:username, :email, :hash, :date_inscription, :token, :date_validite_token)');
                            $req->execute(['username' => $username, 'email' => $email, 'hash' => $hashedPassword, 'date_inscription' => $date_ins, 'token' => $token, 'date_validite_token' => $date_perim]);
                            if ($req) {
                                $content = "<p><a href='authentification.test?p=activation&t=$token'>Merci de cliquer sur ce lien pour activer votre compte</a></p>";
                                $headers = array(
                                    'MIME-Version' => '1.0',
                                    'Content-type' => 'text/html; charset=iso-8859-1',
                                    'X-Mailer' => 'PHP/' . phpversion()
                                );
                                mail($email, "Veuillez activer votre compte", $content, $headers);
                                return array("success", "Inscription réussi. Vous allez recevoir un mail pour activer votre compte");
                                header("Location: home.php");
                            } else {
                                return array("error", "Problème lors de l'enregistrement");
                            }
                        } catch (Exception $e) {
                            return array("error",  $e->getMessage());
                        }
                    } else {
                        return array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
                    }
                } else {
                    return array("error", "Les 2 saisies de mot de passe doivent être identiques.");
                }
            } else {
                return array("error", "Un compte existe déjà pour cet email.");
            }
        } else{
            return array("error", "Veuillez remplir le champ email.");
        }
    }
    

    function logIn($email,$pwd){
        $user= $this->getUserByEmail($email);
        if($user){
            if(password_verify($pwd, $user['hash'])){
                //if($user['actif']){
                    $_SESSION['is_login']=true;
                    //$_SESSION['is_actif']=$user['actif'];
                    $_SESSION['id'] = $user['id_membre'];
                    return array("success", "Connexion réussie :)");               
                //}else return array("error", "Veuillez activer votre compte");
            }else return array("error", "Mauvais identifiants");
        }else return array("error", "Mauvais identifiants");
    }
}
?>
