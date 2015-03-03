<?php include '../testPerPages.php'; ?>
<?php
if (isset($_POST['nom']) && isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['isActive'])) {
    extract($_POST);
    include '../../persistance/CarteService.php';
    include '../../persistance/ConnexionBDD.php';
    include '../../Config.php';
    $persistanceSrv = new CarteService();
    $id = $persistanceSrv->add($nom, $longitude, $latitude);
    if($isActive!=false){
        $persistanceSrv->updateSelectedMap($id);
    }
    echo $id;
} else {
    echo 'ERROR';
}
