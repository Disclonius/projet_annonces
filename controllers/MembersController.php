<?php
require_once "models/MembersManager.php";

class MembersController {
    private $membersManager;

    public function __construct() {
        $this->membersManager = new MembersManager();
    }

    public function getUserData($id) {
        $membersManager = new MembersManager();
        $member = $membersManager->getUserById($id);
        return $member;
    }

    public function showAllMembers() {
        $members = $this->membersManager->getAllMembers();
        include "views/afficher_membres.php";
    }

    public function addUser() {
        $message = $this->membersManager->registerUser();
        return $message;
    }

    public function connectUser(){
        $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        $pwd = $_POST['pwd'];

        $membersManager = new MembersManager;
        $result = $membersManager->logIn($email,$pwd);

        if ($result[0] === "success"){
            $message[1] = "La connexion a réussi!";
            $id = $_SESSION['id'];
            $userData = $this->getUserData($id); 
            $_SESSION['user_data'] = $userData;
            header("Location: index.php");
        } else {
            $error = $result[1];
        }
    }

    public function deleteUser($id){
        $membersManager = new MembersManager();
        $member = $membersManager->deleteUserById($id);
        if ($member) {
                $message = "Success, Le membre a été supprimé avec succès.";
            } else {
                $message = "Error, Erreur lors de la suppression du membre.";
            }
        }
    
    public function showMemberDatas(){
        $membersManager = new MembersController();
        $member = $membersManager->getUserData($_GET['id']);
        include "views/edit_member.php";
    }

    public function updateMemberDatas(){
            $memberManager = new MembersManager();
            $id = $_GET['id'];

            $result = $memberManager->updateMember($id);
            var_dump($result);          
            if ($result[0] === 'success') {
                //header('Location: ...php');
                return $result[1];
                exit();
            } else {
                //header('Location: index.php');
                //exit();
            }
    }
}

?>
