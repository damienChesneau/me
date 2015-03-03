<?php include './testPerPages.php'; ?>
<?php
if (isset($_POST['id'])) {
    extract($_POST);
    include '../persistance/PortfolioService.php';
    $persistanceSrv = new PortfolioService();
    $lignes = $persistanceSrv->getById($id);
    $ligne= $lignes->fetch();
    print $ligne->description;
}  else {
    echo 'ERROR';
}
