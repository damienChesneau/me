<?php include './testPerPages.php'; ?>
<h2 style="margin-top: 0px;">Gestion des utlisateurs</h2>
<p id="messageListeUtilisateurs"></p>
<table id="tableauUtilisateurs" class="table table-hover">
    <thead>
        <tr>
            <td>
                Prénom
            </td>
            <td>
                Nom
            </td>
            <td>
                email
            </td>
            <td style="width: 10px;">
                
            </td>
            <td style="width: 10px;">
                
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../persistance/UtilisateurService.php';
        $persistanceSrv = new UtilisateurService();
        $lignes = $persistanceSrv->getAll();
        while ($ligne = $lignes->fetch()) {

            echo '<tr>
            <td id="tabprenom' . $ligne->id . '"><p id="prenom' . $ligne->id . '">' . $ligne->prenom . '</p></td>
            <td id="tabnom' . $ligne->id . '"><p id="nom' . $ligne->id . '">' . $ligne->nom . '</p></td>
            <td id="tabemail' . $ligne->id . '"><p id="email' . $ligne->id . '">' . $ligne->email . '</p></td>
            <td><a onclick="modifierUser(' . $ligne->id . ',this.parentNode)"><img src="../img/modifier-icon.png"></img></a></td>
            <td id="tabSupprimer' . $ligne->id . '"><a onclick="deleteUser(' . $ligne->id . ',this.parentNode)"><img src="../img/delete-icon.png"></img></a></td>
        </tr>';
        }
        ?> 
    </tbody>
</table>
<hr/>
<h2>Ajout d'un utilisateur</h2>
<p id="messageUtilsateur"></p>
<div class="form-horizontal" role="form">
    <div class="form-group">
        <label for="prenom" class="col-sm-2 control-label">Prénom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="prenom" placeholder="Prénom">
        </div>
    </div>
    <div class="form-group">
        <label for="nom" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nom" placeholder="Nom">
        </div>
    </div>
    <div class="form-group">
        <label for="nom" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="mdp" class="col-sm-2 control-label">Mot de passe</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="mdp" placeholder="Mot de passe">
        </div>
    </div>
    <div class="form-group">
        <label for="mdp2" class="col-sm-2 control-label">Confirmation</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="mdp2" placeholder="Confirmation">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" onclick="validerUtilisateur();" class="btn btn-primary btn-lg">Valider</button>
        </div>
    </div>
</div>
