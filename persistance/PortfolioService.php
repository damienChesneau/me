<?php

include_once '../persistance/ConnexionBDD.php';


/**
 * Description of PortfolioService
 *
 * @author Damien Chesneau <contact@damienchesneau.fr>
 */
class PortfolioService {

    public function getAll() {
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM portfolio");
        $bdd->closeConnexion();
        return $return;
    }
    /**
     * 
     * @param type $titre
     * @param type $description
     * @return Int id du projet inséré.
     */
    public function addProjet($titre, $description) {
        $bdd = new ConnexionBDD();
        $return = $bdd->execWithId("INSERT INTO `portfolio`(`titre`, `description`) VALUES (\"".$titre."\",\"".$description."\")");
        $bdd->closeConnexion();
        return $return;
    }
    /**
     * query : "SELECT id_portfolio,titre, SUBSTR(description,".$start.",".$lenght.") FROM portfolio"
     * @param type $start
     * @param type $lenght
     * @return type
     */
    public function getAllSubStringDescription($start, $lenght) {
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT id_portfolio,titre, SUBSTR(description,".$start.",".$lenght.") FROM portfolio");
        $bdd->closeConnexion();
        return $return;
    }
    public function getById($id){
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM portfolio WHERE id_portfolio =".$id);
        $bdd->closeConnexion();
        return $return;
    }
    public function getImages($portfolioID){
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM image WHERE id_portfolio_ext = ".$portfolioID);
        $bdd->closeConnexion();
        return $return;
    }
    public function getPrimaryImage($portfolioID){
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM image WHERE id_portfolio_ext = ".$portfolioID." AND `primary` = 1");
        $bdd->closeConnexion();
        return $return;
    }
    /**
     * isprimary 1 pour true 0 pour false
     * @param type $id
     * @return type
     */
    public function addImage($url,$isPrimary, $idProjet,$imgDescription){
        $bdd = new ConnexionBDD();
        $return = $bdd->exec("INSERT INTO `image`( `url`, `primary`, `id_portfolio_ext`, `img_description`) VALUES ('".$url."','".$isPrimary."','".$idProjet."',\"".$imgDescription."\")");
        $bdd->closeConnexion();
        return $return;
    }

    public function delete($id){
        $bdd = new ConnexionBDD();
        $return = $bdd->exec("DELETE FROM `portfolio` WHERE `id_portfolio` = '".$id."'");
        $bdd->closeConnexion();
        return $return;
    }
    public function deleteImg($projectId){
        $bdd = new ConnexionBDD();
        $return = $bdd->exec("DELETE FROM `image` WHERE `id_portfolio_ext` = '".$projectId."'");
        $bdd->closeConnexion();
        return $return;
    }
    public function update($id,$titre,$description) {
        $bdd = new ConnexionBDD();
        $bdd->exec("UPDATE `portfolio` SET `titre`='".$titre."',`description`='".$description."' WHERE `id_portfolio`=".$id);
        $bdd->closeConnexion();
    }
}
