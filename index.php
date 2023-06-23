<?php

require_once "models/EtatsManager.php";
require_once "models/MembersManager.php";
session_start();
require_once "helpers/string_helper.php";
require_once "controllers/MembersController.php";
require_once "controllers/ListingsController.php";
require_once "controllers/EtatsController.php";

$p = $_GET['p'] ?? "";
$id = $_GET['id'] ?? "";

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
        case 'update_member':
            $membersController = new MembersController();
            $message = $membersController->updateMemberDatas();
            break;
        case 'update_etat':
            $etatsController = new EtatsController();
            $message = $etatsController->udpateEtatDatas();           
            break;
        case 'put_for_sale':
            $listingsController = new ListingsController();
            $listing = $listingsController->addListing();
        }
}

if ($p =='disconnect') {
	session_unset();
	session_destroy();
	$message= "Vous vous êtes déconnecté(e).";
}
if ($p == 'delete_member'){
    $membersController = new MembersController;
    $membersController->deleteUser($id);
}

$logged = $_SESSION['is_login'] ?? false;

include "views/common/header.php";

switch ($p) {
    case 'connect':
        include "views/connect.php";
        break;
    case 'signup':
        include "views/inscription_page.php";
        break;
    case 'view_members':
        $list_members = new MembersController;
        $members = $list_members->showAllMembers();
        break;
    case 'view_listings':
        break;
    case 'view_etats':
        $etatsController = new EtatsController();
        $etatsController->showAllEtats();
        break;
    case 'view_categories':
        break;
    case 'edit_member':
        $membersController = new MembersController();
        $membersController->showMemberDatas();
        break;
    case 'edit_etat':
        $etatsController = new EtatsController();
        $etatsController->getEtatDatas($id);
        break;
    case 'put_for_sale':
        include 'views/put_for_sale.php';
        break;
    case 'delete_member':
        include "../index.php";
        break;
    default:
        include "views/home.php";
        break;
}

include "views/common/footer.php";

?>