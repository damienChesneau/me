<?php
if(isset($_GET['email'])&& isset($_GET['mdp'])){
    include '../persistance/UtilisateurService.php';
    extract($_GET);
    $persistanceSrv = new UtilisateurService();
    $lignes = $persistanceSrv->getByEmailAndPassword($email, md5($mdp));
    $rowCount = $lignes->rowCount();
    if($rowCount>=1){
        $utilisateur = $lignes->fetch();
        $id = $utilisateur->id;
        session_start();
        $_SESSION['idGestion']= $id; 
        $_SESSION['prenomGestion']= $utilisateur->prenom; 
        $_SESSION['nomGestion']= $utilisateur->nom;
        $_SESSION['emailGestion']= $email;
        $_SESSION['passGestion']= $utilisateur->password;
        echo 'OK';
    }else{
        session_start();
        $_SESSION['idGestion']= "PASOK";
        echo 'ERREUR';
    }
    session_write_close();
}