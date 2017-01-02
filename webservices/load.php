     
var damsc = (function() {
"use strict";
var d = new Date(), status, today = {}, map, correctLocation, isSmallDevice = false;
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
isSmallDevice = true;
}
var franceOffset = +2;
var hour = 3600000;
var localOffset = d.getTimezoneOffset() / 60;
var damienTime = new Date();
var adjustment = (franceOffset - localOffset) * hour;
damienTime.setTime(damienTime - adjustment);
var locations = null;
locations = [
{
message: null,
weekday: null,
start: null,
end: null,
lat: 49.026613,
lng: 1.150646,
toGoogle: "Evreux,  France"
}
];
$(locations).each(function(i, item) {
var startTime = null, endTime = null;
if (today.weekday === item.weekday || item.weekday === null) {
if (item.start !== null) {
startTime = Date.parse(item.start);
}
if (item.end !== null) {
endTime = Date.parse(item.end);
}
if (startTime !== null && endTime !== null) {
if (startTime < d && endTime > d) {
status = item.message;
correctLocation = item;
}
} else {
correctLocation = item;
status = item.message;
}
}
});
$(function() {
$("#whereabouts").html("<span>" + status + "</span>");
if (isSmallDevice) {
return;
}
var longitude = 2.3444653;
var latitude = 48.8595199;
var latlng = null;
var newd = new Date();
var monthInCurrent = newd.getUTCMonth();
latlng = new google.maps.LatLng(latitude, longitude);
//latlng = new google.maps.LatLng(correctLocation.lat, correctLocation.lng);
//        if(monthInCurrent=="8"){
//            latlng = new google.maps.LatLng(47.2413661, 6.0100365);
//        }
//        else{
//            latlng = new google.maps.LatLng(correctLocation.lat, correctLocation.lng);
//        }     
var myOptions = {
zoom: 15,
center: latlng,
disableDefaultUI: true,
mapTypeId: google.maps.MapTypeId.ROADMAP
};
map = new google.maps.Map(document.getElementById("map"), myOptions);
//$("#whereabouts").twipsy();
$("#openMap").removeAttr("disabled").click(function(e) {
e.preventDefault();
document.location = "http://maps.google.com/maps?q=" + correctLocation.toGoogle;
});
});
return {};
})();
