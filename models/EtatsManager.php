<?php
require_once "Model.php";
require_once "Etat.php";

class EtatsManager extends Model {

    public function getAllEtats()
{
    $list = [];
    $req = $this->getDatabase()->prepare("SELECT * FROM etats LIMIT 5");
    $req->execute();

    while ($etatData = $req->fetch(PDO::FETCH_ASSOC)) {
        $etat = new Etat(
            $etatData['id'],
            $etatData['libelle_etat'],
            $etatData['description']
        );
        $list[] = $etat;
    }
    $req->closeCursor();
    return $list;
}


    public function getEtatById($id)
    {
        if (!is_int($id) || $id <= 0) {
            return false;
        }
    
        try {
            $req = $this->getDatabase()->prepare('SELECT * FROM etats WHERE id = :id');
            $req->execute(['id' => $id]);
            $etatData = $req->fetch(PDO::FETCH_ASSOC);
    
            if ($etatData) {
                $etat = new Etat(
                    $etatData['id'],
                    $etatData['libelle_etat'],
                    $etatData['description']
                );
                return $etat;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    
        return false;
    }
    

    public function updateEtat($id){
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);

        try{
            if(!empty($name) && !empty($description)){
                $req = $this->getDatabase()->prepare("UPDATE etats SET libelle_etat = :name, description = :description WHERE id=:id");
                $req->execute(['name' => $name, 'description' => $description, 'id' => $id]);
                return array("sucess","La description de l'état a été mis à jour.");
            } else {
                return array("error","Remplir tous les champs!");
            }
        } catch (Exception $e) {
            return array("error", "Une erreur s'est produite lors de la mise à jour : " . $e->getMessage());
        }
    }}
?>