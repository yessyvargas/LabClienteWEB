/* 
  Función que implenta el uso del API de Google maps para la visualización de la ubicación de la tienda
 */


function myMap() {
	var mapProp= {
		center:new google.maps.LatLng(-0.263671,-78.475342),
		zoom:8,
	};
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}