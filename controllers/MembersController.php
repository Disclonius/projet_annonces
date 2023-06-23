<?php
require_once "models/MembersManager.php";

class MembersController {
    private $membersManager;

    public function __construct() {
        $this->membersManager = new MembersManager();
    }

    public function getUserDatas($id) {
        $member = $this->membersManager->getUserById($id);
        return $member;
    }

    public function showAllMembers() {
        $members = $this->membersManager->getAllMembers();
        include "views/view_members.php";
    }

    public function addUser() {
        $message = $this->membersManager->registerUser();
        return $message;
    }

    public function connectUser(){
        $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        $pwd = $_POST['pwd'];

        $result = $this->membersManager->logIn($email,$pwd);

        if ($result[0] === "success"){
            $message[1] = "La connexion a réussi!";
            $id = $_SESSION['id'];
            $userData = $this->getUserDatas($id); 
            $_SESSION['user_data'] = $userData;
            header("Location: index.php");
        } else {
            $error = $result[1];
        }
    }

    public function deleteUser($id){
        $member = $this->membersManager->deleteUserById($id);
        if ($member) {
                $message = "Success, Le membre a été supprimé avec succès.";
            } else {
                $message = "Error, Erreur lors de la suppression du membre.";
            }
        }
    
    public function showMemberDatas(){
        $membersManager = new MembersController();
        $member = $membersManager->getUserDatas($_GET['id']);
        include "views/edit_member.php";
    }

    public function updateMemberDatas(){
            $id = $_GET['id'];
            $result = $this->membersManager->updateMember($id);
            var_dump($result);          
            if ($result[0] === 'success') {
                header('Location: index.php');
                return $result[1];
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
    }
}

?>
