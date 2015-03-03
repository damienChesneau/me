<?php include './testPerPages.php'; ?>
<h2 style="margin-top: 0px;">Gestion des localisations</h2>
<p id="messageListeLocalisation"></p>
<table id="tableauLocalisations" class="table table-hover">
    <thead>
        <tr>
            <td style="width: 10px;">
                 
            </td>
            <td>
                Nom 
            </td>
            <td>
                Longitude
            </td>
            <td>
                Latitude
            </td>
            <td style="width: 10px;">
                
            </td>
            <td style="width: 10px;">
                
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../persistance/CarteService.php';
        include '../Path.php';
        $persistanceSrv = new CarteService();
        $lignes = $persistanceSrv->getAll();
        $lignesChoisi=  $persistanceSrv->getLocalisationChoisi();
        $loc = $lignesChoisi->fetch();
        $idLocChoisi = $loc->id_Localisation_Choisi;
        while ($ligne = $lignes->fetch()) {
            $link="";
            if($idLocChoisi == $ligne->id_loc_dispo ){
                $link = "<img id=\"star\" height=\"20\" src=\"../img/star-icon.png\"></img>";
            }else{
                $link = "<img onclick=\"updateSelectedLocalisation(".$ligne->id_loc_dispo.",this);\"height=\"20\" src=\"../img/add-icon.png\"></img>";
            } 
            echo '<tr> 
                <td id="tabchoisi' . $ligne->id_loc_dispo . '"><p id="choisi' . $ligne->id_loc_dispo . '">' . $link . '</p></td>
                <td id="tabnom' . $ligne->id_loc_dispo . '"><p id="nom' . $ligne->id_loc_dispo . '">' . $ligne->NOM . '</p></td>
                <td id="tablongitude' . $ligne->id_loc_dispo . '"><p id="longitude' . $ligne->id_loc_dispo . '">' . $ligne->LONGITUDE . '</p></td>
                <td id="tablatitude' . $ligne->id_loc_dispo . '"><p id="latitude' . $ligne->id_loc_dispo . '">' . $ligne->LATITUDE . '</p></td>
                <td><a onclick="modifierLocalisation(' . $ligne->id_loc_dispo . ',this.parentNode)"><img src="../img/modifier-icon.png"></img></a></td>
                <td id="tabSupprimer' . $ligne->id_loc_dispo . '"><a onclick="deleteLocalisation(' . $ligne->id_loc_dispo . ',this.parentNode)"><img src="../img/delete-icon.png"></img></a></td>
        </tr>';
        }
        ?> 
    </tbody>
</table>
<h2 style="margin-top: 0px;">Ajouter une localisation<small>&nbsp;<a onclick="geolocalisationGetDialog();" >Ajouter avec géolocalisation</a></small></h2>
<p id="messageAjoutLocalisation"></p>
<div class="form-horizontal" role="form">
    <div class="form-group">
        <label for="nom" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nom" placeholder="Nom">
        </div>
    </div>
    <div class="form-group"> 
        <label for="longitude" class="col-sm-2 control-label">Longitude</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="longitude" placeholder="Longitude">
        </div>
    </div>
    <div class="form-group">
        <label for="latitude" class="col-sm-2 control-label">Latitude</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="latitude" placeholder="Latitude">
        </div>
    </div>
    <div class="form-group">
        <label for="active" class="col-sm-2 control-label">Activé</label>
        <div class="col-sm-10">
            <input type="checkbox" class="form-control" id="active" placeholder="Activé">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" onclick="validerLocalisation();" class="btn btn-primary btn-lg">Valider</button>
        </div>
    </div>
</div>
