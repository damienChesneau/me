<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <?php
        include '../persistance/PortfolioService.php';
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $persistanceSrv = new PortfolioService();
            $portLignes = $persistanceSrv->getById($id);
            $maPortLigne = $portLignes->fetch();
            $titre = $maPortLigne->titre;
            $description = $maPortLigne->description;
            echo '<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">' . $titre . '</h3>
            </div>
            <div class="modal-body">    <div style="width: 550px; 
height: 125px; 
overflow: auto; 
white-space: nowrap; 
overflow-y: hidden; ">       ';
            $ligneimage = $persistanceSrv->getImages($maPortLigne->id_portfolio);
            while ($maLignePourImg = $ligneimage->fetch()) {
                echo '<a style="height: 100px;"class="fancybox" rel="gallery1" href="' . $maLignePourImg->url . '" title="' . $maLignePourImg->img_description . '">
	<img style="height: 100px;" src="' . $maLignePourImg->url . '" alt="" />
</a>';
            }
            echo '</div><br/><p style="text-align: justify;">' . $description . '</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>';
        }
        ?>

    </div>
</div>