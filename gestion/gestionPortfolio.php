<?php include './testPerPages.php'; ?>
<h2 style="margin-top: 0px;">Gestion des projets</h2>
<p id="messageListeProjets"></p>
<table id="tableauProjets" class="table table-hover">
    <thead>
        <tr>
            <td>
                Titre
            </td>
            <td>
                Description
            </td>
            <td style="width: 10px;">
                
            </td>
            <td style="width: 10px;">
                
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../persistance/PortfolioService.php';
        $persistanceSrv = new PortfolioService();
        $lignes = $persistanceSrv->getAll();
        $descriptionLongue = $ligne->description;
        while ($ligne = $lignes->fetch()) {
            $description = $ligne->description;
            $descLenght = 70;
            if ((strlen($description)) > $descLenght) {
                $moin = strlen($description) - $descLenght;
                $description = substr($description, 0, -$moin);
                $description = $description . " (...)";
            }
            echo '<tr>
            <td id="tabtitre' . $ligne->id_portfolio . '"><p id="titre' . $ligne->id_portfolio . '">' . $ligne->titre . '</p></td>
            <td id="tabdescription' . $ligne->id_portfolio . '"><p id="description' . $ligne->id_portfolio . '">' . $description . '</p></td>
            <td id="tabModifier' . $ligne->id_portfolio . '"><a onclick="modifierProjet(' . $ligne->id_portfolio . ',this.parentNode)" id="modifier' . $ligne->id_portfolio . '"><img src="../img/modifier-icon.png"></img></a></td>
            <td id="tabSuppression' . $ligne->id_portfolio . '"><a onclick="deleteProjet(' . $ligne->id_portfolio . ',this.parentNode);" id="suppression' . $ligne->id_portfolio . '"><img src="../img/delete-icon.png"></img></a></td> 
        </tr>';
        }
        ?> 
    </tbody>
</table>
<hr/>
<h2>Ajout d'un projet</h2>
<p id="messageUtilsateur"></p>
<div id="divAjouterProjet" class="form-horizontal" role="form">
    <form action="file.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre" class="col-sm-2 control-label">Titre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="titre" placeholder="Titre"/>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control" id="description" placeholder="Description"></textarea>
            </div>
        </div>
        <div id="divImagesProjet">
            <div class="form-group">
                <label for="file1" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <input type="file"  name="file1" class="form-control" id="file1"  placeholder="Image ">
                    <div class="input-group" >
                        <input id="descriptionFile1" class="form-control" placeholder="Description" type="text" />
                        <span class="input-group-addon" onclick="moreImg();">+</span><br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" onclick="validerProjet();" class="btn btn-primary btn-lg" value="Valider">
            </div>
        </div>
    </form>
</div>
<script>
    (function() {
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
        $('form').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
            }
        });
    })();
</script>