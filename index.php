<?php

session_start();

require_once "helpers/string_helper.php";
require_once "controllers/MembersController.php";

$p = $_GET['p'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'connect':
            $membersController = new MembersController();
            $message = $membersController->connectUser();
            break;
        case 'signup':
            $membersController = new MembersController();
            $message = $membersController->addUser();
            break;
    }
}

$logged = $_SESSION['is_login'] ?? false;

include "views/common/header.php";

switch ($p) {
    case 'connect':
        include "views/connexion_page.php";
        break;
    case 'signup':
        include "views/inscription_page.php";
        break;
    case 'members':
        MembersController::showAllMembers();
        break;
    case 'modify_member':
        include "views/modify_member.php";
        break;
    case 'delete_member':
        include "views/delete_member.php";
        break;
    default:
        include "views/home.php";
        break;
}

include "views/common/footer.php";

?>
