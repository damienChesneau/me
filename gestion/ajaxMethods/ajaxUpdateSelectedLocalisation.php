<?php include '../testPerPages.php'; ?>
<?php
if(isset($_POST['id'])){
    extract($_POST);
    include '../../persistance/CarteService.php';
    include '../../persistance/ConnexionBDD.php';
    include '../../Config.php';
    $persistanceSrv = new CarteService();
    $persistanceSrv->updateSelectedMap($id);
    echo 'OK';
}  else {
    echo 'ERROR';
}
