<?php get_header(); ?>

	<!-- section -->
	<section id="main" role="main">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h2>
				<?php the_title(); ?>
			</h2>
			<!-- /post title -->

			<?php the_content(); // Dynamic Content ?>

			<?php
				$quantidade = get_post_meta( get_the_ID(), 'quantidade', true );
				$preco = get_post_meta( get_the_ID(), 'preco', true );

				echo "
					<p>Quantidade: <span>$quantidade</span></p>
					<p>Preço: <span>R$ $preco</span></p>
				";
			?>

			<h3 class="abrirMapa"><a href="<?php echo home_url(); ?>#mapa">Encontre uma loja perto de você</a></h3>


		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'boca' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->

<?php get_footer(); ?>