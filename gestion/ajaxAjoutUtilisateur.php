<?php include './testPerPages.php'; ?>
<?php
if(isset($_GET['prenom']) && isset($_GET['nom']) && isset($_GET['email'])&& isset($_GET['mdp'])){
    extract($_GET);
    include '../persistance/UtilisateurService.php';
    $persistanceSrv = new UtilisateurService();
    $primaryKey =  $persistanceSrv->add($prenom, $nom, $email, md5($mdp));
    echo $primaryKey;
}else{
    echo 'ERROR';
}