function writeFr(){
    $("#title-what-I-Do").text("Je suis Ingénieur Logiciel chez Dassault Systèmes.");
    $("#to-contact-me").text("Pour me contacter :");
}
function writeEn(){
    $("#title-what-I-Do").text("I'm a Software Engineer at Dassault Systèmes.");
    $("#to-contact-me").text("To contact me :");
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

