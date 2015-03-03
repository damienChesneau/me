<?php

include_once '../persistance/ConnexionBDD.php';

/**
 * Description of UtilisateurService
 *
 * @author Damien Chesneau <contact@damienchesneau.fr>
 */
class UtilisateurService {

    public function getAll() {
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM utlisateurs");
        $bdd->closeConnexion();
        return $return;
    }

    public function getByEmailAndPassword($email, $password) {
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM utlisateurs WHERE `email` ='" . $email . "' AND `password` ='" . $password . "'");
        $bdd->closeConnexion();
        return $return;
    }

    public function getByEmailAndPasswordAndId($email, $password, $id) {
        $bdd = new ConnexionBDD();
        $return = $bdd->query("SELECT * FROM utlisateurs WHERE `email` ='" . $email . "' AND `password` ='" . $password . "' AND `id` ='" . $id . "'");
        $bdd->closeConnexion();
        return $return;
    }
    
    public function add($prenom, $nom, $email, $password) {
        $bdd = new ConnexionBDD();
        $primaryKey = $bdd->execWithId("INSERT INTO `utlisateurs`(`nom`, `prenom`, `email`, `password`) VALUES ('" . $nom . "','" . $prenom . "','" . $email . "','" . $password . "')");
        $bdd->closeConnexion();
        return $primaryKey;
    }
    
    public function delete($id) {
        $bdd = new ConnexionBDD();
        $bdd->exec("DELETE FROM `utlisateurs` WHERE `id` = '".$id."'");
        $bdd->closeConnexion();
    }
    
    public function update($id,$prenom,$nom,$email) {
        $bdd = new ConnexionBDD();
        $bdd->exec("UPDATE `utlisateurs` SET `nom`='".$nom."',`prenom`='".$prenom."',`email`='".$email."' WHERE `id`=".$id);
        $bdd->closeConnexion();
    }

}
