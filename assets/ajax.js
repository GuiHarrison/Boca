jQuery(document).ready(function() {
	
	var pegou = jQuery(this).attr('href');
	
	jQuery("#conteudo .cadaSabor a").click(function(){ 
		jQuery.ajax({
			
			type: 'POST',

			url: $(this).attr('href')+' #main',

			data: {
			  action: 'pegarSabor',
			  pegou: pegou,
			},

			success: function(data, textStatus, XMLHttpRequest){
			  jQuery("#conteudo").html('');
			  jQuery("#conteudo").append(data);
			},

			error: function(MLHttpRequest, textStatus, errorThrown){
				alert(errorThrown);
			}
			
		});
	});
});