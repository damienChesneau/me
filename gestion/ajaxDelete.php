<?php include './testPerPages.php'; ?>
<?php
if(isset($_GET['id'])){
    extract($_GET);
    include '../persistance/UtilisateurService.php';
    $persistanceSrv = new UtilisateurService();
    $persistanceSrv->delete($id);
    echo 'OK';
}  else {
    echo 'ERROR';
}
