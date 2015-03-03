<?php include './testPerPages.php'; ?>
<?php
if (isset($_POST['nb'])&& isset($_POST['titre']) && isset($_POST['description'])) {
    include '../persistance/PortfolioService.php';
    $persistanceSrv = new PortfolioService();
    $idProjet = $persistanceSrv->addProjet($_POST['titre'],$_POST['description']);
    $nb = $_POST['nb'];
    $arrayFile = $_POST['queryFile'];
    $arrayDescription = $_POST['queryDescription'];
    for($i=0 ; $i < count($arrayFile) ; $i++){
        $fileName = $arrayFile[$i];
        $descriptionFile = $arrayDescription[$i];
        $isPrimary =0;
        if($i == 0){
            $isPrimary =1;
        }else{
            $isPrimary =0;
        }
        $persistanceSrv->addImage("../uploads/".$fileName, $isPrimary, $idProjet, $descriptionFile);
    }
    echo $idProjet;
}  else {
    echo 'ERROR';
}










/*if (isset($_GET['nb'])&& isset($_GET['titre']) && isset($_GET['description'])) {
    include '../persistance/PortfolioService.php';
    $persistanceSrv = new PortfolioService();
    $idProjet = $persistanceSrv->addProjet($_GET['titre'],$_GET['description']);
    $nb = $_GET['nb'];
    for($i=1 ; $i < $nb+1 ; $i++){
        
        $fileName = $_GET['file'.$i];
        $descriptionFile = $_GET['descriptionFile'.$i];
        $isPrimary =0;
        if($i == 1){
            $isPrimary =1;
        }else{
            $isPrimary =0;
        }
        
        $persistanceSrv->addImage("../uploads/".$fileName, $isPrimary, $idProjet, $descriptionFile);
    }
    
    echo $idProjet;
}  else {
    echo 'ERROR';
}