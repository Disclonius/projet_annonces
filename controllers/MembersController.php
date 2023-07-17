<?php
require_once "models/MembersManager.php";

class MembersController {
    private $membersManager;

    public function __construct() {
        $this->membersManager = new MembersManager();
    }

    public static function showAllMembers() {
        $membersManager = new MembersManager();
        $members = $membersManager->getAllMembers();
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
            header("Location: ../index.php");
        } else {
            $error = $result[1];
        }
    }
    
    public function getUserById($id) {
        $membersManager = new MembersManager();
        $membre = $membersManager->getUserById($id);
        echo $membre['username'];
        }
}
?>
