<?php include '../testPerPages.php'; ?>
<?php
if (isset($_POST['id']) && isset($_POST['longitude']) && isset($_POST['latitude'])&& isset($_POST['nom']) ) {
    extract($_POST);
    include '../../persistance/CarteService.php';
    include '../../persistance/ConnexionBDD.php';
    include '../../Config.php';
    $persistanceSrv = new CarteService();
    $persistanceSrv->update($id, $nom, $longitude, $latitude);
    echo 'OK';
} else {
    echo 'ERROR';
}
