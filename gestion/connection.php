<style>
    #main{
        height: 270px;
    }
</style>
<form class="form-signin"  role="form">
    <h2 class="form-signin-heading">Connectez-vous</h2>
    <p id="message"></p>
    <input id="email" type="email" class="form-control" placeholder="Email" required autofocus>
    <input id="mdp" type="password" class="form-control" placeholder="Mot de passe" required><br/>
    <button class="btn btn-lg btn-primary btn-block"  onclick="ajaxConnection()" type="button">Se connecter</button>
</form>