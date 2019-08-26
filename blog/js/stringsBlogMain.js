function writeFr(){
    $("#article-duplication").find("a[name=title]").text("");
    $("#article-duplication").find("a[name=date]").text("23 Aout 2019");
    $("#article-duplication").find("p[name=little-description]").text("");

    $("#first-article").find("a[name=title]").text("");
    $("#first-article").find("a[name=date]").text("19 Aout 2019");
    $("#first-article").find("p[name=little-description]").text("Alors voici ici l'annonce pour l'ouverture de mon blog");

    $("#copyright").html("© Copyright Damien Chesneau "+ new Date().getFullYear());
    $("#switch-lang").html("View in <a href=\"javascript:toEn();\" >English</a>");
}
function writeEn(){

    $("#first-article").find("a[name=title]").text("");
    $("#first-article").find("a[name=date]").text("");
    $("#first-article").find("p[name=little-description]").text("");

    $("#copyright").html(" "+ new Date().getFullYear());
    $("#switch-lang").html("");
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
    if (userLang) {
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

