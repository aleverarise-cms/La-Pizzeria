$ = jQuery.noConflict();

var map;
function initMap() {
	var latLng = {
		lat: parseFloat(opciones.latitud),
		lng: parseFloat(opciones.longitud)
	};
	map = new google.maps.Map(document.getElementById('mapa'), {
	  	center: latLng,
	  	zoom: parseInt(opciones.zoom)
	});

	var marker = new google.maps.Marker({
		position: latLng,
		map: map,
		title: 'La pizzeria',
	});
}

$(document).ready(function() {



	// OCULTAR Y MOSTRAR MENU
	$('.mobile-menu a').on('click', function(event) {
		event.preventDefault();
		$('nav.menu-sitio').toggle('slow');
	});

	// REACCIONAR A RESIZE EN LA PANTALLA
	var breakpoint = 768;
	$(window).resize(function(){
		if($(document).width() >= breakpoint ){
			$('nav.menu-sitio').show();
		}else{
			$('nav.menu-sitio').hide();
		}
	});

	// FLUIDBOX
	$('.gallery a').each(function (){
		$(this).attr({'data-fluidbox' : ''});
	});

	if($('[data-fluidbox]').length > 0){
		$('[data-fluidbox]').fluidbox();
	}

	// $(function () {
	//     $('.gallery a').fluidbox();
	// });

	// AJUSTAR MAPA
	var mapa = $('#mapa');

	if(mapa.length > 0){
		if($(document).width() >= breakpoint){
			ajustarMapa(0);
		}else{
			ajustarMapa(300);
		}
	}
	$(window).resize(function(event) {
		if($(document).width() >= breakpoint){
			ajustarMapa(0);
		}else{
			ajustarMapa(300);
		}
	});



});

function ajustarMapa(altura){
	if(altura == 0){
		var ubicacionSection = $('.ubicacion-reservacion');
		var ubicacionAltura = ubicacionSection.height();
		$('#mapa').css('height', ubicacionAltura);
	}else{
		$('#mapa').css('height', altura);
	}
}