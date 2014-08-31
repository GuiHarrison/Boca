$(document).ready(function() {

	$('.cadaSabor a').click(function(e) {

		e.preventDefault();

		$('#carregou').remove();
		$('body').append('<div id="carregou"></div>');

		var carregando = '<h2>Carregando...</h2>';
		var aCarregar = $(this).attr('href') + ' .produtos';

		$('#carregou')
		.html(carregando)
		.load(aCarregar);

	});

	$('body').on('click','#carregou',(function() {
		$('#carregou').fadeOut('fast').remove();
	}));

});