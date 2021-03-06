<?php get_header(); ?>
	
	<!-- section -->
	<section id="main" role="main">
		
		<h1>Cardápio</h1>

		<ul id="sabores">
			<li><a class="mini-brigadeiro" href="<?php echo get_category_link( 3 ); ?>">Doces de festas</a></li>
			<li><a class="mini-coxinha" href="<?php echo get_category_link( 4 ); ?>">Salgados de festas</a></li>
			<li><a class="mini-tortasDoces" href="<?php echo get_category_link( 1 ); ?>">Tortas doces</a></li>
			<li><a class="mini-tortasSalgadas" href="<?php echo get_category_link( 5 ); ?>">Tortas salgadas</a></li>
			<li><a class="mini-kit" href="<?php echo get_category_link( 6 ); ?>">Kit festa</a></li>
		</ul>

		<div id="conteudo">
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
		</div>
		
	</section>
	<!-- /section -->
	
<?php get_footer(); ?>