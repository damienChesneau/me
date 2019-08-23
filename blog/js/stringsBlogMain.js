function writeFr(){
    $("#article-duplication").find("a[name=title]").text("Ouverture de mon blog.");
    $("#article-duplication").find("a[name=date]").text("23 Aout 2019");
    $("#article-duplication").find("p[name=little-description]").text("Alors voici ici l'annonce pour l'ouverture de mon blog.");

    $("#first-article").find("a[name=title]").text("Ouverture de mon blog :)");
    $("#first-article").find("a[name=date]").text("19 Aout 2019");
    $("#first-article").find("p[name=little-description]").text("Alors voici ici l'annonce pour l'ouverture de mon blog");

    $("#copyright").html("© Copyright Damien Chesneau "+ new Date().getFullYear());
    $("#switch-lang").html("View in <a href=\"javascript:toEn();\" >English</a>");
}
function writeEn(){
    $("#article-duplication").find("a[name=title]").text("The duplication a boost for your project.");
    $("#article-duplication").find("a[name=date]").text("Aout 19 2019");
    $("#article-duplication").find("p[name=little-description]").text("In this first post I'll explain to you how sometimes we can put intentionally duplicated portions of code in the project. Not the dirty way... Yes you well read that right, we'll voluntarily write duplicated code... Heavy consequences...");

    $("#first-article").find("a[name=title]").text("My blog opening.");
    $("#first-article").find("a[name=date]").text("Aout 23 2019");
    $("#first-article").find("p[name=little-description]").text("So here is the announcement of the opening of my blog");

    $("#copyright").html("© Copyright Damien Chesneau "+ new Date().getFullYear());
    $("#switch-lang").html("Voir en <a href=\"javascript:toFrench();\" >Français</a>");
}

function toFrench(){
    reloadWithQueryStringVars({"lang": "fr"});
}

function toEn(){
    reloadWithQueryStringVars({"lang": "en"});
}

function reloadWithQueryStringVars (queryStringVars) {
    var existingQueryVars = location.search ? location.search.substring(1).split("&") : [],
        currentUrl = location.search ? location.href.replace(location.search,"") : location.href,
        newQueryVars = {},
        newUrl = currentUrl + "?";
    if(existingQueryVars.length > 0) {
        for (var i = 0; i < existingQueryVars.length; i++) {
            var pair = existingQueryVars[i].split("=");
            newQueryVars[pair[0]] = pair[1];
        }
    }
    if(queryStringVars) {
        for (var queryStringVar in queryStringVars) {
            newQueryVars[queryStringVar] = queryStringVars[queryStringVar];
        }
    }
    if(newQueryVars) {
        for (var newQueryVar in newQueryVars) {
            newUrl += newQueryVar + "=" + newQueryVars[newQueryVar] + "&";
        }
        newUrl = newUrl.substring(0, newUrl.length-1);
        window.location.href = newUrl;
    } else {
        window.location.href = location.href;
    }
}

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, ''));
};
$( document ).ready(function() {
    var a = getUrlParameter("lang");
    var userLang = navigator.language || navigator.userLanguage;
    if (a) {
        if(a==="fr" || a==="FR"){
            userLang ="fr-FR";
        }else if(a==="en" || a==="EN"){
            userLang ="en-EN";
        }
    }
    if(userLang.includes("FR") || userLang.includes("fr")){
        writeFr();
    }else{
        writeEn();
    }
});

