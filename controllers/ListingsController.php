<?php
require_once "models/MembersManager.php";
require_once "models/ListingsManager.php";
require_once "models/Categorie.php";

class ListingsController {
    private $listingsManager;

    public function __construct(){
        $this->listingsManager = new ListingsManager();
    }

    public function addListing(){
        $listing = $this->listingsManager->addListing();
    }

    public function getCategorie(){

    }
} 

?>