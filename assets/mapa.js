var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {	
	var latlng = new google.maps.LatLng(-19.922787, -43.945141);
	
    var options = {
        zoom: 14,
		center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    };

    map = new google.maps.Map(document.getElementById("innerMapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {
 
	$.getJSON('/boca/wp-content/themes/boca/assets/pontos.json', function(pontos) {

		$.each(pontos, function(index, ponto) {

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
				title: "Encontre o Boca do Forno mais perto de você!",
				map: map,
				icon: '/boca/wp-content/themes/boca/img/icons/ponto.png'
			});

			var myOptions = {
		        content: ponto.Texto,
		        pixelOffset: new google.maps.Size(-150, 0)
		    };
		 
		    infoBox[ponto.Id] = new InfoBox(myOptions);
		    infoBox[ponto.Id].marker = marker;
		 
		    infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
		        abrirInfoBox(ponto.Id, marker);
		    });

			markers[ponto.Id]=marker;

		});
	});

};

function clicarNoMenu(i) {
  google.maps.event.trigger(markers[i], "click");
}
 
carregarPontos();