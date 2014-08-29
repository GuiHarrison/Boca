$(document).ready(function(){

	$(".slide:eq(0)").addClass("ativo").show();

	setInterval(rodando,3000);

	function rodando () {
		
		if($(".ativo").next().size()) {
			$(".ativo").fadeOut().removeClass("ativo").next().fadeIn().addClass("ativo");
		} 
		
		else {
			$(".ativo").fadeOut().removeClass("ativo");
			$(".slide:eq(0)").fadeIn().addClass("ativo");
		}
	}
})