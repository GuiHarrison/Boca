$(document).ready(function(){$(".cadaSabor a, .slider a").click(function(r){r.preventDefault(),$("#carregou").remove(),$("body").append('<div id="carregou"></div>');var a='<h2 id="carregando">Carregando...</h2>',e=$(this).attr("href")+" .produtos";$("#carregou").html(a).load(e)}),$("body").on("click","#carregou",function(){$("#carregou").fadeOut("fast").remove()})});