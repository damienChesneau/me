<?php include './testPerPages.php'; ?>
<?php
if (isset($_GET['id']) && isset($_GET['prenom']) && isset($_GET['nom']) && isset($_GET['email'])) {
    extract($_GET);
    include '../persistance/UtilisateurService.php';
    $persistanceSrv = new UtilisateurService();
    $persistanceSrv->update($id,$prenom,$nom,$email);
    echo 'OK';
} else {
    echo 'ERROR';
}
