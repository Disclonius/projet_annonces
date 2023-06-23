<?php
require_once "models/EtatsManager.php";

class EtatsController {
    private $etatsManager;

    public function __construct(){
        $this->etatsManager = new EtatsManager();
    }

    public function showAllEtats() {
        $etats = $this->etatsManager->getAllEtats();
        include 'views/view_etats.php';
    }

    public function getEtatDatas($id){
        $etat = $this->etatsManager->getEtatById($id);
        //return $etat;
        include 'views/edit_etat.php';
    }

    public function udpateEtatDatas(){
        $id = $_GET['id'];
        $result = $this->etatsManager->updateEtat($id);
        if($result[0] === "sucess"){
            return $result[1];
        }elseif($result[0] === "error"){
            return $result[1];
        }
        if($result){
        include 'views/view_etats.php';
        }
    }

}

?>