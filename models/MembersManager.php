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

    public function getUserById($id) {
        try {
            $req = $this->getDatabase()->prepare('SELECT * FROM membres WHERE id= :id');
            $req->execute(['id' => $id]);
            $memberData = $req->fetch(PDO::FETCH_ASSOC);
            if ($memberData) {
                $member = new Member(
                    $memberData['id'],
                    $memberData['is_admin'],
                    $memberData['username'],
                    $memberData['email'],
                    $memberData['hash'],
                    $memberData['prenom'],
                    $memberData['nom'],
                    $memberData['date_naissance'],
                    $memberData['num_telephone'],
                    $memberData['adresse_postale'],
                    $memberData['code_postal'],
                    $memberData['ville'],
                    $memberData['date_inscription'],
                    $memberData['token'],
                    $memberData['date_validite_token'],
                    $memberData['solde_cagnotte']
                );
                return $member;
            }
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
                $member['id'],
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

    public function registerUser()
    {
        $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if (!empty($email)) {
            if (!$this->getUserByEmail($email)) {
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
                                header("Location: index.php");
                                return array("success", "Inscription réussie. Vous allez recevoir un email pour activer votre compte");
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
        } else {
            return array("error", "Veuillez remplir le champ email.");
        }
    }

    public function logIn($email,$pwd){
        $user= $this->getUserByEmail($email);
        if($user){
            if(password_verify($pwd, $user['hash'])){
                //if($user['actif']){
                    $_SESSION['is_login']=true;
                    //$_SESSION['is_actif']=$user['actif'];
                    $_SESSION['id'] = $user['id'];
                    return array("success", "Connexion réussie :)");               
                //}else return array("error", "Veuillez activer votre compte");
            }else return array("error", "Mauvais identifiants");
        }else return array("error", "Mauvais identifiants");
    }

    public function deleteUserById($id){
        try {
            $member = $this->getUserById($id);

            $req = $this->getDatabase()->prepare('DELETE FROM membres WHERE id = :id');
            $req->execute(['id'=>$id]);
            
            if ($req->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateMember($id) {
        $username = $_POST['username'];
        $email = filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname']; 
        $birthdate = $_POST['birthdate'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $zipcode = $_POST['zipcode'];
        $city = $_POST['city'];
        
        try {
            if (!empty($id) && !empty($email)) {
                if (!empty($username) && strlen($username) >= 3) {
                    if (preg_match('/^0\d{4}$|^[1-9]\d{4}$/', $zipcode)) {
                        if (preg_match('/^\d{10}$/', $phone)) {
                            $req = $this->getDatabase()->prepare("UPDATE membres SET username = :username, email = :email, prenom = :firstname, nom = :lastname, date_naissance = :birthdate, num_telephone = :phone, adresse_postale = :address, code_postal = :zipcode, ville = :city WHERE id = :id");
                            $req->bindParam(':username', $username);
                            $req->bindParam(':email', $email);
                            $req->bindParam(':firstname', $firstname);
                            $req->bindParam(':lastname', $lastname);
                            $req->bindParam(':birthdate', $birthdate);
                            $req->bindParam(':phone', $phone);
                            $req->bindParam(':address', $address);
                            $req->bindParam(':zipcode', $zipcode);
                            $req->bindParam(':city', $city);
                            $req->bindParam(':id', $id);
                            $req->execute();
                            return array("success", "Membre mis à jour avec succès");
                        } else {
                            return array("error", "Le numéro de téléphone doit être composé de 10 chiffres");
                        }
                    } else {
                        return array("error", "Le code postal doit être composé de 5 chiffres");
                    }
                } else {
                    return array("error", "L'username doit comporter au moins 3 caractères");
                }
            } else {
                return array("error", "L'email doit être renseigné");
            }
        } catch (Exception $e) {
            return array("error", "Une erreur s'est produite lors de la mise à jour du membre : " . $e->getMessage());
        }
    }

}
?>
