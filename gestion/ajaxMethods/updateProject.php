<?php include '../testPerPages.php'; ?>
<?php
if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['id'])){
    extract($_POST);
    include '../../persistance/PortfolioService.php';
    include '../../persistance/ConnexionBDD.php';
    include '../../Config.php';
    $persistanceSrv = new PortfolioService();
    $persistanceSrv->update($id, $titre, $description);
    echo 'OK';
}else{
    echo 'ERROR';
}
