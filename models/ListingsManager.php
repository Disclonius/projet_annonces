<?php
require_once "Model.php";
require_once "Member.php";
require_once "Listing.php";
require_once "Etat.php";
require_once "Categorie.php";

class ListingsManager extends Model {

    /*public function addListing()
    {
        $title = htmlentities($_POST['title']);
        $desc = htmlentities($_POST['description']);
        $price = filter_var(filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT)); 
        $etat = match($_POST['etat']){
            'neuf' => 1,
            'meh' => 2,
            'nul' => 3
        };
        $duration = match($_POST['duration']){
            'une_semaine' => 7,
            'deux_semaines' => 14,
            'un_mois' => 30
        };
        $begin_date = date('Y-m-d H:i:s');
        $end_date = date('Y-m-d H:i:s', strtotime('+'.$duration.' days',strtotime(date('Y-m-d H:i:s'))));

        if(!empty($title)){
            if(!empty($desc)){
                if(!empty($price)){   
                    if($etat !== ""){
                        try {
                            $req = $this->getDatabase()->prepare('INSERT INTO annonces (date_creation, titre, description, duree_de_publication, prix_vente, date_fin_publication, id_etat, id_utilisateur) VALUES (:date_creation, :titre, :description,:duree_de_publication, :prix_vente, :date_fin_publication, :id_etat, :id_utilisateur)');
                            $req->execute(['date_creation' => $begin_date, 'titre' => $title, 'description' => $desc, 'duree_de_publication' => $duration, 'prix_vente' => $price, 'date_fin_publication' => $end_date, 'id_etat' => $etat, 'id_utilisateur' => $_SESSION['user_data']->getId()]);
                        } catch (Exception $e){
                            echo $e->getMessage();
                        }
                    } 
                }else {
                    return array("error","Veuillez renseigner le prix de votre annonce.");
                }
            } else {
                return array("error","Veuillez décrire l'article.");
            }
        } else {
            return array("error","Veuillez renseigner le titre de l'annonce.");
        }
    }
}*/

    public function addListing()
    {
        $title = htmlentities($_POST['title']);
        $desc = htmlentities($_POST['description']);
        $price = filter_var(filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT)); 
        $etat = match ($_POST['etat']) {
            'neuf' => 1,
            'meh' => 2,
            'nul' => 3
        };
        $duration = match ($_POST['duration']) {
            'une_semaine' => 7,
            'deux_semaines' => 14,
            'un_mois' => 30
        };
        $begin_date = date('Y-m-d H:i:s');
        $end_date = date('Y-m-d H:i:s', strtotime('+'.$duration.' days',strtotime(date('Y-m-d H:i:s'))));

        if (!empty($title)) {
            if (strlen($title) > 100) {
                return array("error", "Le titre de l'annonce ne doit pas dépasser 100 caractères.");
            }
            return array("error", "Veuillez renseigner le titre de l'annonce.");
        }

        if (!empty($desc)) {
            if (strlen($desc) > 1000) {
                return array("error", "La description de l'annonce ne doit pas dépasser 1000 caractères.");
            }
        }else{
            return array("error", "Veuillez décrire l'article.");
        }

        if (!empty($price)) {
            if ($price <= 0) {
                return array("error", "Le prix de l'annonce doit être supérieur à zéro.");
            }            
        } else {
            return array("error", "Veuillez renseigner le prix de votre annonce.");
        }

        if ($etat === "") {
            return array("error", "Veuillez sélectionner l'état de l'annonce.");
        }

        if ($duration === "") {
            return array("error", "Veuillez sélectionner la durée de l'annonce.");
        }

        try {
            $req = $this->getDatabase()->prepare('INSERT INTO annonces (date_creation, titre, description, duree_de_publication, prix_vente, date_fin_publication, id_etat, id_utilisateur) VALUES (:date_creation, :titre, :description, :duree_de_publication, :prix_vente, :date_fin_publication, :id_etat, :id_utilisateur)');
            $req->execute([
                'date_creation' => $begin_date,
                'titre' => $title,
                'description' => $desc,
                'duree_de_publication' => $duration,
                'prix_vente' => $price,
                'date_fin_publication' => $end_date,
                'id_etat' => $etat,
                'id_utilisateur' => $_SESSION['user_data']->getId()
            ]);

            return array("success", "L'annonce a été publiée avec succès.");
        } catch (Exception $e) {
            echo $e->getMessage();
            return array("error", "Une erreur s'est produite lors de la publication de l'annonce.");
        }
        /*
        public function addListing()
{
    // ... code existant ...

    // Vérifier si des fichiers ont été uploadés
    if (isset($_FILES['file']) && !empty($_FILES['file']['name'][0])) {
        $imagePaths = [];
        $imageDirectory = 'path/to/image/directory/';

        // Parcourir les fichiers uploadés
        foreach ($_FILES['file']['tmp_name'] as $index => $tmpName) {
            $fileName = $_FILES['file']['name'][$index];
            $destination = $imageDirectory . $fileName;

            // Déplacer le fichier vers le répertoire d'images
            if (move_uploaded_file($tmpName, $destination)) {
                // Enregistrer le chemin d'accès dans la base de données
                $imagePaths[] = $destination;
            }
        }

        // Enregistrer les chemins d'accès des images dans la base de données
        // Vous pouvez ajuster la logique en fonction de votre structure de base de données
        if (!empty($imagePaths)) {
            try {
                $listingId = 123; // ID de l'annonce créée

                // Parcourir les chemins d'accès des images et les enregistrer dans la table des images
                foreach ($imagePaths as $imagePath) {
                    $req = $this->getDatabase()->prepare('INSERT INTO images (listing_id, image_path) VALUES (:listing_id, :image_path)');
                    $req->execute(['listing_id' => $listingId, 'image_path' => $imagePath]);
                }
            } catch (Exception $e) {
                // Gérer les erreurs d'enregistrement des images
                echo $e->getMessage();
            }
        }
    }

    // ... suite du code existant ...
}

        */
    }
}

?>