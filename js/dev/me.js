function showModal() {
    $('#myModal').modal('show');
}
function ajaxRequest(id) {
    $.ajax({
        url: 'ajaxDialog.php?id=' + id,
        type: 'GET',
        dataType: 'text',
        error: function() {
            alert("PB");
        },
        success: function(text) {
            document.getElementById("inner").innerHTML = text;
            showModal();
        } 
    });
}
function ajaxConnection() {
    setNewErrorMessage("");
    var email = $("#email").val();
    if (!emailValidate(email)) {
        $("#message").text("Le email inscrit n'est pas sous le bon format.");
    } else {
        var mdp = $("#mdp").val();
        $.ajax({
            url: 'AjaxConnexion.php?email=' + email + '&mdp=' + mdp,
            type: 'GET',
            dataType: 'text',
            error: function() {
                $("#message").text("Une erreur est survenu.");
            },
            success: function(text) {
                if (text.indexOf("OK") !== -1) {
                    setNewSuccessMessage("Connexion authorisé.");
                    document.location = "./";
                } else if (text.indexOf("ERREUR") !== -1) {
                    setNewErrorMessage("Connexion refusé.");
                }
            }
        });
    }
}
function ajaxVerifIfConnected() {
    $.ajax({
        url: 'ajaxVerifyIfConnected.php',
        type: 'GET',
        dataType: 'text',
        error: function() {
            document.location = "./";
        },
        success: function(text) {

        }
    });
}
function setNewInfoMessage(message) {
    $("#message").text(message);
}
function setNewSuccessMessage(message) {
    document.getElementById("message").style.color = "green";
    $("#message").text(message);
}
function setNewErrorMessage(message) {
    document.getElementById("message").style.color = "red";
    $("#message").text(message);
}
function ajaxDeconnection() {
    $.ajax({
        url: 'AjaxDeconnection.php',
        type: 'POST',
        dataType: 'text',
        error: function() {
            $("#message").text("Une erreur est survenu.");
        },
        success: function(text) {
            document.location = "./";
        }
    });
}
function emailValidate(email) {
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length)
    {
        return false;
    } else {
        return true;
    }
}//  
function getGestionPortfolio() {
    $.ajax({
        url: 'gestionPortfolio.php',
        type: 'GET',
        dataType: 'text',
        error: function() {
//            $("#message").text("Une erreur est survenu.");
        },
        success: function(text) {
            $("#content").html(text);
            deselectAll();
            document.getElementById("gestionPortfolioLink").className = "list-group-item active";
        }
    });
}
function getGestionCarte() {
    $.ajax({
        url: 'gestionCarte.php',
        type: 'GET',
        dataType: 'text',
        error: function() {
//            $("#message").text("Une erreur est survenu.");
        },
        success: function(text) {
            $("#content").html(text);
            deselectAll();
            document.getElementById("gestionCarteLink").className = "list-group-item active";
        }
    });
}
function getGestionUtlisateurs() {
    $.ajax({
        url: 'gestionUtilisateurs.php',
        type: 'GET',
        dataType: 'text',
        error: function() {
//            $("#message").text("Une erreur est survenu.");
        },
        success: function(text) {
            $("#content").html(text);
            deselectAll();
            document.getElementById("gestionUtilisateursLink").className = "list-group-item active";
        }
    });
}
function deselectAll() {
    document.getElementById("gestionPortfolioLink").className = "list-group-item";
    document.getElementById("gestionUtilisateursLink").className = "list-group-item";
    document.getElementById("gestionCarteLink").className = "list-group-item";
}
function validerUtilisateur() {
    var prenom = $("#prenom").val();
    var nom = $("#nom").val();
    var email = $("#email").val();
    var mdp = $("#mdp").val();
    var mdp2 = $("#mdp2").val();
    var id = "";
    if (mdp == mdp2) {
        if (emailValidate(email)) {
            $.ajax({
                url: 'ajaxAjoutUtilisateur.php?prenom=' + prenom + '&nom=' + nom + '&email=' + email + '&mdp=' + mdp,
                type: 'GET',
                dataType: 'text',
                error: function() {
                    setNewErrorMessageUtlisateur("Une erreur est survenu.");
                },
                success: function(text) {
                    if (!text.indexOf("ERROR") !== -1) {// faire avec jquery !
                        var table = document.getElementById("tableauUtilisateurs");
                        var ligne = table.insertRow(table.rows.length);
                        var col1 = ligne.insertCell(0);
                        var col2 = ligne.insertCell(1);
                        var col3 = ligne.insertCell(2);
                        var col4 = ligne.insertCell(3);
                        var col5 = ligne.insertCell(4);
                        col1.innerHTML = prenom;
                        col2.innerHTML = nom;
                        col3.innerHTML = email;
                        col4.innerHTML = "<a onclick=\"modifierUser(" + text + ",this.parentNode)\"><img src=\"../img/modifier-icon.png\"></img></a>"
                        col5.innerHTML = "<a onclick=\"deleteUser(" + text + ")\"><img src=\"../img/delete-icon.png\"></img></a>";
                    } else {
                        setNewErrorMessageUtlisateur("Une erreur est survenu lors de l'ajout.")
                    }
                }
            });
        } else {
            setNewErrorMessageUtlisateur("L'adresse email n'est pas au bon format.");
        }

    } else {
        setNewErrorMessageUtlisateur("Les deux mots de passes ne correspondent pas.");
    }
}
function setNewInfoMessageUtlisateur(message) {
    $("#messageUtilsateur").text(message);
}
function setNewSuccessMessageUtlisateur(message) {
    document.getElementById("messagemessageUtilsateur").style.color = "green";
    $("#messageUtilsateur").text(message);
}
function setNewErrorMessageUtlisateur(message) {
    document.getElementById("messageUtilsateur").style.color = "red";
    $("#messageUtilsateur").text(message);
}
function deleteUser(id, index) {
    $.ajax({
        url: 'ajaxDelete.php?id=' + id,
        type: 'GET',
        dataType: 'text',
        error: function() {
            setNewErrorMessageUtlisateur("Une erreur est survenu.");
        },
        success: function(text) {
            if (text.indexOf("OK") !== -1) {
                index.parentNode.remove();
            } if (text.indexOf("ERROR") !== -1) {
                setNewErrorMessageUtlisateur("Une erreur est survenu lors de l'ajout.");
            }
        }
    });
}
var idSelectedToUpdate = "";
var isInUpdate = false;
function modifierUser(id, index) {
    if (!isInUpdate) {
        isInUpdate = true;
        idSelectedToUpdate = id;
        var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"annuler(" + id + ");\">Annuler</a>");
        var prenom = $("#prenom" + id).text();
        var nom = $("#nom" + id).text();
        var email = $("#email" + id).text();
        var tabPrenom = $("#tabprenom" + id).html("<input id=\"inputprenom" + id + "\" type=\"text\" value=\"" + prenom + "\"/>");
        var tabPrenom = $("#tabnom" + id).html("<input id=\"inputnom" + id + "\" type=\"text\" value=" + nom + "></input>");
        var tabEmail = $("#tabemail" + id).html("<input id=\"inputemail" + id + "\" type=\"text\" value=" + email + "></input>");
    } else {
        var prenomUpdated = ($("#inputprenom" + id).val());
        var nomUpdated = ($("#inputnom" + id).val());
        var emailUpdated = ($("#inputemail" + id).val());
        $.ajax({
            url: 'ajaxUpdateUser.php?id=' + id + '&prenom=' + prenomUpdated + "&nom=" + nomUpdated + "&email=" + emailUpdated,
            type: 'GET',
            dataType: 'text',
            error: function() {
                setNewErrorMessageListeUtilisateurs("Une erreur est survenu.");
            },
            success: function(text) {
                if (text.indexOf("OK") !== -1) {
                    var tabPrenom = $("#tabprenom" + id).html("<p id=\"prenom" + id + "\">" + prenomUpdated + "</p>");
                    var tabPrenom = $("#tabnom" + id).html("<p id=\"nom" + id + "\">" + nomUpdated + "</p>");
                    var tabEmail = $("#tabemail" + id).html("<p id=\"email" + id + "\">" + emailUpdated + "</p>");
                    var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"deleteUser(" + id + ",this.parentNode)\"><img src=\"../img/delete-icon.png\"></img></a>");
                    setNewSuccessMessageListeUtilisateurs("Modification bien éffectué.");
                    window.setTimeout(setNewSuccessMessageListeUtilisateurs(""), 3000);
                } else if (text.indexOf("ERROR") !== -1) {
                    setNewErrorMessageListeUtilisateurs("Une erreur est survenu lors de la modification.");
                }
            }
        });
        isInUpdate = false;
    }
}
function annuler(id) {
    var prenomUpdated = ($("#inputprenom" + id).val());
    var nomUpdated = ($("#inputnom" + id).val());
    var emailUpdated = ($("#inputemail" + id).val());
    var tabPrenom = $("#tabprenom" + id).html("<p id=\"prenom" + id + "\">" + prenomUpdated + "</p>");
    var tabPrenom = $("#tabnom" + id).html("<p id=\"nom" + id + "\">" + nomUpdated + "</p>");
    var tabEmail = $("#tabemail" + id).html("<p id=\"email" + id + "\">" + emailUpdated + "</p>");
    var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"deleteUser(" + id + ",this.parentNode)\"><img src=\"../img/delete-icon.png\"></img></a>");
    idSelectedToUpdate = "";
    isInUpdate = false;
}
function setNewMessageListeUtilisateurs(message) {
    $("#messageListeUtilisateurs").text(message);
}
function setNewSuccessMessageListeUtilisateurs(message) {
    document.getElementById("messageListeUtilisateurs").style.color = "green";
    $("#messageListeUtilisateurs").text(message);
}
function setNewErrorMessageListeUtilisateurs(message) {
    document.getElementById("messageListeUtilisateurs").style.color = "red";
    $("#messageListeUtilisateurs").text(message);
}
function sleep(milliSeconds) {
    var startTime = new Date().getTime();
    while (new Date().getTime() < startTime + milliSeconds)
        ;
}
function deleteProjet(id, index) {
    $.ajax({
        url: 'ajaxDeleteProject.php?id=' + id,
        type: 'GET',
        dataType: 'text',
        error: function() {
            setNewErrorMessageListeProjets("Une erreur est survenu.");
        },
        success: function(text) {
            if (text.indexOf("OK") !== -1) {
                index.parentNode.remove();
            } else {
                setNewErrorMessageListeProjets("Une erreur est survenu lors de la suppression.");
            }
        }
    });
}
function setNewMessageListeProjets(message) {
    $("#messageListeProjets").text(message);
}
function setNewSuccessMessageListeProjets(message) {
    document.getElementById("messageListeProjets").style.color = "green";
    $("#messageListeProjets").text(message);
}
function setNewErrorMessageListeProjets(message) {
    document.getElementById("messageListeProjets").style.color = "red";
    $("#messageListeProjets").text(message);
}
var nb = 1;
function validerProjet() {
    var queryFile = "";
    var queryDescription = "";
    var arrayFile = new Array();
    var arrayDescription = new Array();
    for (i = 1; i < nb + 1; i++) {

        var fileId = "file" + i;
        var descriptionId = "descriptionFile" + i;
        var fileName = $("#" + fileId).val();
        var ret = "C:\\fakepath\\";
        fileName = fileName.substring(12, fileName.lenght);
        var description = $("#" + descriptionId).val();
        queryDescription += "&" + descriptionId + "=" + description;
        queryFile += "&" + fileId + "=" + fileName;
        arrayFile[i - 1] = fileName;
        arrayDescription[i - 1] = description;
    }
    var descriptionProjet = $("#description").val();
    var titreProjet = $("#titre").val();
    $.ajax({
        url: 'ajaxAddProjet.php?nb=' + nb + queryFile + queryDescription + '&titre=' + titreProjet + '&description=' + descriptionProjet,
        type: 'POST',
        data: {nb: nb, queryFile: arrayFile, queryDescription: arrayDescription, titre: titreProjet, description: descriptionProjet},
        dataType: 'text',
        error: function() {
            setNewErrorMessageListeProjets("Une erreur est survenu.");
        },
        success: function(text) {
            var id = text;
            if (text.indexOf("ERROR") !== -1) {
                setNewErrorMessageListeProjets("Une erreur est survenu lors de l'ajout.");
            } else {
                setNewSuccessMessageListeProjets("Projet bien ajouté !");
                $("#description").val("");
                $("#titre").val("");
                $("#divImagesProjet").html("<div class=\"form-group\"><label for=\"file1\" class=\"col-sm-2 control-label\">Image</label><div class=\"col-sm-10\"><input type=\"file\" class=\"form-control\" name=\"file1\" id=\"file1\" placeholder=\"Image \"><div class=\"input-group\" ><input id=\"descriptionFile1\" class=\"form-control\" placeholder=\"Description\" type=\"text\" /><span onclick=\"moreImg();\" class=\"input-group-addon\">+</span></div></div></div>");
                if ((descriptionProjet.length) > 205) {
                    var moin = descriptionProjet.length - 205;
                    descriptionProjet = descriptionProjet.substr(0, 80);
                    descriptionProjet = descriptionProjet + " (...)";
                }
                $("#tableauProjets > tbody:last").append("<tr><td id=\"tabtitre" + id + "\"><p id=\"titre" + id + "\">" + titreProjet + "</p></td><td id=\"tabdescription" + id + "\"><p id=\"description" + id + "\">" + descriptionProjet + "</p></td><td id=\"tabModifier" + id + "\"><a id=\"modifier" + id + "\" onclick=\"modifierProjet(" + id + ",this.parentNode)\"><img src=\"../img/modifier-icon.png\"></img></a></td>            <td id=\"tabSuppression" + id + "\"><a onclick=\"deleteProjet(" + id + ",this.parentNode);\" id=\"suppression" + id + "\"><img src=\"../img/delete-icon.png\"></img></a></td><tr>");
            }
        }
    });
}
function moreImg() {
    nb++;
    var html = $("#divImagesProjet").html();
    $("#divImagesProjet").append("<div class=\"form-group\"><label for=\"file" + nb + "\" class=\"col-sm-2 control-label\">Image " + nb + "</label><div class=\"col-sm-10\"><input type=\"file\" class=\"form-control\" name=\"file" + nb + "\" id=\"file" + nb + "\" placeholder=\"Image \"><div class=\"input-group\" ><input id=\"descriptionFile" + nb + "\" class=\"form-control\" placeholder=\"Description\" type=\"text\" /><span onclick=\"moreImg();\" class=\"input-group-addon\">+</span></div></div></div>");
}
var idProjetSelectedToUpdate = "";
var isProjetInUpdate = false;
var titreUp;
var descriptionUp;
function modifierProjet(id, index) {
    titreUp = $("#titre" + id).text();
    descriptionUp = $("#description" + id).html();
    if (!isProjetInUpdate) {
        $.ajax({
            url: 'ajaxGetProjectDescription.php',
            type: 'POST',
            data: {id: id},
            dataType: 'text',
            error: function() {
                setNewErrorMessageListeProjets("Une erreur est survenu.");
            },
            success: function(text) {
                isProjetInUpdate = true;
                idProjetSelectedToUpdate = id;
                var tabSupprimer = $("#tabSuppression" + id).html("<a onclick=\"annulerProjet(" + id + ");\">Annuler</a>");
                var description = text;
                var tabTitre = $("#tabtitre" + id).html("<input id=\"inputtitre" + id + "\" type=\"text\" value=\"" + titreUp + "\"/>");
                var tabDescription = $("#tabdescription" + id).html("<textarea cols=\"60\" rows=\"5\" id=\"inputdescription" + id + "\" type=\"text\" >" + description + "</textarea>");
            }
        });
    } else {
        var titreUpdated = ($("#inputtitre" + id).val());
        var descriptionUpdatetd = ($("#inputdescription" + id).val());
        $.ajax({
            url: 'ajaxMethods/updateProject.php',
            type: 'POST',
            data: {id: id, titre: titreUpdated, description: descriptionUpdatetd},
            dataType: 'text',
            error: function() {
                setNewErrorMessageListeProjets("Une erreur est survenu.");
            },
            success: function(text) {
                if (!text.indexOf("ERROR") !== -1) {
                    var tab = $("#tabtitre" + id).html("<p id=\"titre" + id + "\">" + titreUpdated + "</p>");
                    if ((descriptionUpdatetd.length) > 205) {
                        var moin = descriptionUpdatetd.length - 205;
                        descriptionUpdatetd = descriptionUpdatetd.substr(0, 80);
                        descriptionUpdatetd = descriptionUpdatetd + " (...)";
                    }
                    var tabPrenom = $("#tabdescription" + id).html("<p id=\"description" + id + "\">" + descriptionUpdatetd + "</p>");
                    var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"deleteProjet(" + id + ",this.parentNode);\" id=\"suppression" + id + "\"><img src=\"../img/delete-icon.png\"></img></a>");
                    idProjetSelectedToUpdate = "";
                    isProjetInUpdate = false;
                    setNewSuccessMessageListeProjets("Modification bien éffectué.");
                    window.setTimeout(setNewSuccessMessageListeUtilisateurs(""), 3000);
                } else {
                    setNewErrorMessageListeUtilisateurs("Une erreur est survenu lors de la modification.");
                }
            }
        });
        isProjetInUpdate = false;
    }
}
function annulerProjet(id) {
    var tab = $("#tabtitre" + id).html("<p id=\"titre" + id + "\">" + titreUp + "</p>");
    var tabPrenom = $("#tabdescription" + id).html("<p id=\"description" + id + "\">" + descriptionUp + "</p>");
    var tabSupprimer = $("#tabSuppression" + id).html("<a onclick=\"deleteProjet(" + id + ",this.parentNode); \" id=\"suppression" + id + "\"><img src=\"../img/delete-icon.png\"></img></a>");
    idProjetSelectedToUpdate = "";
    isProjetInUpdate = false;
}
function maPosition(position) {
    var infopos = "Position déterminée :\n";
    infopos += "Latitude : " + position.coords.latitude + "\n";
    infopos += "Longitude: " + position.coords.longitude + "\n";
    infopos += "Altitude : " + position.coords.altitude + "\n";
    document.getElementById("infoposition").innerHTML = infopos;
}
function showModalGeolocalisation() {
    $('#myModal2').modal('show');
}
function geolocalisationGetDialog(id) {
    $.ajax({
        url: 'ajaxMethods/ajaxDialogGeolocalisation.php',
        type: 'POST',
        dataType: 'text',
        error: function() {
            setNewErrorMessageListeLocalisation("Un problème est survenu.");
        },
        success: function(text) {
            document.getElementById("inner").innerHTML = text;
            showModalGeolocalisation();
        }
    });
}
window.closeModal = function() {
    $('#myModal2').modal('hide');
};
function validerLocalisation() {
    var nom = $("#nom").val();
    var longitude = $("#longitude").val();
    var latitude = $("#latitude").val();
    var isActive = $("#active").is(':checked');
    $.ajax({
        url: 'ajaxMethods/ajaxAddLocalisation.php',
        type: 'POST',
        dataType: 'text',
        data: {nom: nom, longitude: longitude, latitude: latitude, isActive: isActive},
        error: function() {
            setNewErrorMessageListeLocalisation("Un problème est survenu l'ajout n'a pas été effectué.");
        },
        success: function(text) {
            if (!text.indexOf("ERROR") !== -1) {
                var pl = "";
                setNewSuccessMessageListeLocalisation("La localisation a bien été ajoutée.");
                if (isActive) {
                    document.getElementById("star").parentNode.innerHTML = "<img height=\"20\" src=\"../img/add-icon.png\"></img>";
                    $("#tableauLocalisations > tbody:last").append("<tr><td id=\"tabchoisi" + text + "\"><p id=\"choisi" + text + "\"><img id=\"star\" height=\"20\" src=\"../img/star-icon.png\"></img></p></td>\n\
                <td id=\"tabnom" + text + "\"><p id=\"nom" + text + "\">" + nom + "</p></td>\n\\n\
                <td id=\"tablongitude" + text + "\"><p id=\"longitude" + text + "\">" + longitude + "</p></td>\n\
                <td id=\"tablatitude" + text + "\"><p id= \"latitude" + text + "\">" + latitude + "</p></td>\n\
                <td><a onclick=\"modifierLocalisation(" + text + ",this.parentNode)\"><img src=\"../img/modifier-icon.png\"></img></a></td>\n\
                <td id=\"tabSupprimer" + text + "\"><a onclick=\"deleteLocalisation(" + text + ",this.parentNode)\"><img src=\"../img/delete-icon.png\"></img></a></td>\n\
        </tr>");
                } else {
                    $("#tableauLocalisations > tbody:last").append("<tr><td id=\"tabchoisi" + text + "\"><p id=\"choisi" + text + "\"><img height=\"20\" src=\"../img/add-icon.png\"></img></p></td>\n\
                <td id=\"tabnom" + text + "\"><p id=\"nom" + text + "\">" + nom + "</p></td>\n\\n\
                <td id=\"tablongitude" + text + "\"><p id=\"longitude" + text + "\">" + longitude + "</p></td>\n\
                <td id=\"tablatitude" + text + "\"><p id= \"latitude" + text + "\">" + latitude + "</p></td>\n\
                <td><a onclick=\"modifierLocalisation(" + text + ",this.parentNode)\"><img src=\"../img/modifier-icon.png\"></img></a></td>\n\
                <td id=\"tabSupprimer" + text + "\"><a onclick=\"deleteLocalisation(" + text + ",this.parentNode)\"><img src=\"../img/delete-icon.png\"></img></a></td>\n\
        </tr>");
                }
            } else {
                setNewErrorMessageListeLocalisation("Un problème est survenu lors de l'ajout de la localisation.");
            }
        }
    });
}
function setNewMessageListeLocalisation(message) {
    $("#messageListeLocalisation").text(message);
}
function setNewSuccessMessageListeLocalisation(message) {
    document.getElementById("messageListeLocalisation").style.color = "green";
    $("#messageListeLocalisation").text(message);
}
function setNewErrorMessageListeLocalisation(message) {
    document.getElementById("messageListeLocalisation").style.color = "red";
    $("#messageListeLocalisation").text(message);
}

function deleteLocalisation(id, index) {
    $.ajax({
        url: 'ajaxMethods/ajaxDeleteLocalisation.php',
        type: 'POST',
        dataType: 'text',
        data: {id: id},
        error: function() {
            setNewErrorMessageListeLocalisation("Une erreur est survenu.");
        },
        success: function(text) {
            if (text.indexOf("OK") !== -1) {
                index.parentNode.remove();
            } else {
                setNewErrorMessageListeLocalisation("Une erreur est survenu lors de la suppression.");
            }
        }
    });
}
function updateSelectedLocalisation(id, element) {
    $.ajax({
        url: 'ajaxMethods/ajaxUpdateSelectedLocalisation.php',
        type: 'POST',
        dataType: 'text',
        data: {id: id},
        error: function() {
            setNewErrorMessageListeLocalisation("Une erreur est survenu.");
        },
        success: function(text) {
            if (text.indexOf("OK") !== -1) {
                document.getElementById("star").parentNode.innerHTML = "<img height=\"20\" src=\"../img/add-icon.png\"></img>";
                element.parentNode.innerHTML = "<img id=\"star\" height=\"20\" src=\"../img/star-icon.png\"></img>";
            } else {
                setNewErrorMessageListeLocalisation("Une erreur est survenu lors de la modification.");
            }
        }
    });
}
var localisationInUpdate = false;
var idLocalisationToUpdate;
var oldnom;
var oldLongitude;
var oldLatitude;
function modifierLocalisation(id, index) {
    if (!localisationInUpdate) {
        localisationInUpdate = true;
        idLocalisationToUpdate = id;
        var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"annulerLocalisation(" + id + ");\">Annuler</a>");
        oldnom = $("#tabnom" + id).text();
        oldLongitude = $("#tablongitude" + id).text();
        oldLatitude = $("#tablatitude" + id).text();
        var tabNom = $("#tabnom" + id).html("<input id=\"inputnom" + id + "\" type=\"text\" value=\"" + oldnom + "\"/>");
        var tabLongitude = $("#tablongitude" + id).html("<input id=\"inputlongitude" + id + "\" type=\"text\" value=" + oldLongitude + "></input>");
        var tabLatitude = $("#tablatitude" + id).html("<input id=\"inputlatitude" + id + "\" type=\"text\" value=" + oldLatitude + "></input>");
    } else {
        var nomUpdated = ($("#inputnom" + id).val());
        var longitudeUpdated = ($("#inputlongitude" + id).val());
        var latitudeUpdated = ($("#inputlatitude" + id).val());
        $.ajax({
            url: 'ajaxMethods/ajaxUpdateLocalisation.php',
            type: 'POST',
            dataType: 'text',
            data: {id: id, nom: nomUpdated, longitude: longitudeUpdated, latitude: latitudeUpdated},
            error: function() {
                setNewErrorMessageListeLocalisation("Une erreur est survenu.");
            },
            success: function(text) {
                if (text.indexOf("OK") !== -1) {
                    var tab = $("#tabnom" + id).html("<p id=\"nom" + id + "\">" + nomUpdated + "</p>");
                    var tabLongitude = $("#tablongitude" + id).html("<p id=\"longitude" + id + "\">" + longitudeUpdated + "</p>");
                    var tabLatitude = $("#tablatitude" + id).html("<p id=\"latitude" + id + "\">" + latitudeUpdated + "</p>");
                    var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"deleteLocalisation(" + id + ",this.parentNode)\"><img src=\"../img/delete-icon.png\"></img></a>");

                    setNewSuccessMessageListeLocalisation("Modification bien éffectué.");
                } else if (text.indexOf("ERROR") !== -1) {
                    setNewErrorMessageListeLocalisation("Une erreur est survenu lors de la modification.");
                }
            }
        });
        localisationInUpdate = false;
    }
}
function annulerLocalisation(id) {
    var tab = $("#tabnom" + id).html("<p id=\"nom" + id + "\">" + oldnom + "</p>");
    var tabLongitude = $("#tablongitude" + id).html("<p id=\"longitude" + id + "\">" + oldLongitude + "</p>");
    var tabLatitude = $("#tablatitude" + id).html("<p id=\"latitude" + id + "\">" + oldLatitude + "</p>");
    var tabSupprimer = $("#tabSupprimer" + id).html("<a onclick=\"deleteLocalisation(" + id + ",this.parentNode)\"><img src=\"../img/delete-icon.png\"></img></a>");
    idProjetSelectedToUpdate = "";
    isProjetInUpdate = false;
}
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47421440-1', 'damienchesneau.fr');
  ga('send', 'pageview');