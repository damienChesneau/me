function writeFr(){
    var title = "Ouverture de mon blog :)";
    $("h1[name=title]").text(title);
    $("li[name=date]").text("23 Aout 2019");

    $("#firstp").text("Alors voici ici l'annonce pour l'ouverture de mon blog.");
    $("head > title").text("Blog - " + title);

    $("#copyright").html("© Copyright Damien Chesneau "+ new Date().getFullYear());
    $("#switch-lang").html("View in <a href=\"javascript:toEn();\" >English</a>");
}
function writeEn(){
    var title ="My blog opening :)";
    $("h1[name=title]").text(title);
    $("li[name=date]").text("Aout 23 2019");

    $("#firstp").text("So here is the announcement of the opening of my blog.");
    $("head > title").text("Blog - " + title);

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
        console.log("a:",a);
    var userLang = navigator.language || navigator.userLanguage;
    if (a) {
        if(a==="fr" || a==="FR"){
            userLang ="fr-FR";
        }else if(a==="en" || a==="EN"){
            userLang ="en-EN";
        }
    }
    console.log("Language:",userLang);
    if(userLang.includes("FR") || userLang.includes("fr")){
        writeFr();
    }else{
        writeEn();
    }
});

