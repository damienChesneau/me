<style>
    #main{
        height: 600px;
        width: 1200px;
    }
</style>
<button class="btn btn-sm btn-danger" style="position: relative; left: 90%;" onclick="ajaxDeconnection();" >Déconnection</button>
<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group" style="width: 100%;">
                <a id="gestionPortfolioLink" onclick="getGestionPortfolio();" class="list-group-item active">
                    Portfolio
                </a>
                <a id="gestionUtilisateursLink" onclick="getGestionUtlisateurs();" class="list-group-item">Utilisateurs </a>
                <a id="gestionCarteLink" onclick="getGestionCarte();" class="list-group-item">Carte</a>
            </div>
        </div> 
        <div class="col-md-10">
            <div id="content" style="
                 height: 500px;
                 overflow-x: hidden; 
                 " >
            </div>
        </div>
    </div>
</div></div>
    <div id="inner"></div>
</div>
</div>

</div>
</div>
<script>
    window.onload = function() {
        ajaxVerifIfConnected();
        getGestionPortfolio();
    };
</script>