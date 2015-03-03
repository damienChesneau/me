<?php

include_once '../persistance/ConnexionBDD.php';


/**
 * Description of CarteService
 *
 * @author Damien Chesneau <contact@damienchesneau.fr>
 */
class CarteService {

    public function getAll() {
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM  `localisationsDisponible` ");
        $bdd->closeConnexion();
        return $return;
    }
    public function getLocalisationChoisi(){
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM  `localisationChoisi`");
        $bdd->closeConnexion();
        return $return;
    }
    public function add($nom,$longitude,$latitude){
        $bdd = new ConnexionBDD();
        $return = $bdd->execWithId("INSERT INTO `localisationsDisponible`( `NOM`, `LONGITUDE`, `LATITUDE`) VALUES ('".$nom."','".$longitude."','".$latitude."')");
        $bdd->closeConnexion();
        return $return;
    }
    public function updateSelectedMap($id){
        $bdd = new ConnexionBDD();
        $return = $bdd->exec("UPDATE `localisationChoisi` SET `id_Localisation_Choisi`=".$id." WHERE  id_Localisation = 1");
        $bdd->closeConnexion();
        return $return;
    }
    public function delete($id){
        $bdd = new ConnexionBDD();
        $return = $bdd->exec("DELETE FROM `localisationsDisponible` WHERE `id_loc_dispo`='".$id."'");
        $bdd->closeConnexion();
        return $return;
    }
    public function update($id,$nom,$longitude,$latitude){
        $bdd = new ConnexionBDD();
        $return = $bdd->exec("UPDATE `localisationsDisponible` SET `NOM`='".$nom."',`LONGITUDE`='".$longitude."',`LATITUDE`='".$latitude."' WHERE `id_loc_dispo`='".$id."'");
        $bdd->closeConnexion();
        return $return;
    }
    public function count(){
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT count(*) FROM `localisationsDisponible`");
        $bdd->closeConnexion();
        return $return->fetchColumn();
    }
    public function getCurrentLocalisation(){
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM `localisationChoisi` LEFT JOIN  `localisationsDisponible` ON  `id_Localisation_Choisi` =  `id_loc_dispo`");
        $bdd->closeConnexion();
        return $return;
    }
}