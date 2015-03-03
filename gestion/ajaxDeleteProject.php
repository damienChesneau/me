<?php include './testPerPages.php'; ?>
<?php

if (isset($_GET['id'])) {
    extract($_GET);
    include '../persistance/PortfolioService.php';
    $persistanceSrv = new PortfolioService();
    $lignes = $persistanceSrv->getImages($id);
    while ($ligne = $lignes->fetch()) {
        unlink($ligne->url);
    }
    $persistanceSrv->deleteImg($id);
    $persistanceSrv->delete($id);
    echo 'OK';
}  else {
    echo 'ERROR';
}
