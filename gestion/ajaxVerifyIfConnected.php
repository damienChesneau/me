
<?php

session_start();
if (isset($_SESSION['emailGestion']) && isset($_SESSION['passGestion']) && isset($_SESSION['idGestion'])) {
    include '../persistance/UtilisateurService.php';
    extract($_SESSION);
    $persistanceSrv = new UtilisateurService();
    $lignes = $persistanceSrv->getByEmailAndPasswordAndId($emailGestion, $passGestion, $idGestion);
    $rowCount = $lignes->rowCount();
    if ($rowCount >= 1) {
        echo 'OK';
    } else {
        $_SESSION['idGestion'] = "PASOK";
        echo 'ERREUR';
    }
}
