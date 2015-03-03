<style>
    #main{
        margin-top: 7%;
        height: auto;
        width: 100%;
    }
</style>
<div class="page-header" style="margin: 0px 0 20px;">
    <h3>Mon portfolio <small>Sont inscrit aussi bien mes projets école, ceux effectué pendant des stages et personnel.</small></h3>
</div>
<div class="row">
    <?php
    include '../persistance/PortfolioService.php';
    $persistanceSrv = new PortfolioService();
    $portLignes = $persistanceSrv->getAll();
    while ($maPortLigne = $portLignes->fetch()) {
        $ligneimage =$persistanceSrv->getPrimaryImage($maPortLigne->id_portfolio);  
        $maLigneImage = $ligneimage->fetch();
        $litleDescription = $maPortLigne->description;
        if ((strlen($litleDescription)) > 205) {
            $moin = strlen($litleDescription) - 205;
            $litleDescription = substr($litleDescription, 0, -$moin);
            $litleDescription = $litleDescription . " (...)";
        }
        echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                    <div class="thumbnail">
                        <img style="height: 200px;" src="' . $maLigneImage->url . '" alt="...">
                        <div class="caption">
                            <h3>' . $maPortLigne->titre . '</h3> 
                            <p style="text-align: justify;">' . $litleDescription . '</p>
                            <p><a  class="btn btn-primary" onclick="ajaxRequest(' . $maPortLigne->id_portfolio . ');" role="button">En savoir plus</a> </p>
                         </div>
                    </div>
            </div>';
    }
    ?> </div>
</div>
    <div id="inner"></div>
</div>
</div>

