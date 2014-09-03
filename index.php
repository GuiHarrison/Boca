<?php get_header(); ?>

	<!-- blocos -->

	<section id="home" class="tela">
		<div class="central">
		<nav class="barraHome" id="menu-da-home">
			<ul id="menu-da-home-paginas">
				<li><a id="item-home" data-scroll href="#home">Início</a></li>
				<li><a id="item-cardapio" data-scroll href="#cardapio">Cardápio</a></li>
				<li><a id="item-sobre" data-scroll href="#sobre">Sobre</a></li>
				<li><a id="item-mapa" class="item-sem-linha" data-scroll href="#mapa">Lojas</a></li>
				<li>
					<a data-scroll class="item-sem-linha logo" href="#home">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="bobounce logo-img">
					</a>
				</li>
				<li><a class="item-contato" data-scroll href="#contato">Trabalhe Conosco</a></li>
				<li><a class="item-sem-linha item-contato" data-scroll href="#contato">Contato</a></li>
			</ul>
			<ul id="menu-da-home-redes">
				<li><a class="facebook" href="">fb</a></li>
				<li><a class="twitter" href="">tw</a></li>
				<li><a class="YouTube" href="">yt</a></li>
			</ul>
		</nav>
			<?php sliderNaHome(); ?>
		</div>
	</section>

	<section class="tela" id="cardapio" >
		<div class="central">
			<h1>Cardápio</h1>
			<ul id="categorias">
				<li class="bobounce"><a class="brigadeiro" href="<?php echo get_category_link( 3 ); ?>">Doces de festas</a></li>
				<li class="bobounce"><a class="coxinha" href="<?php echo get_category_link( 4 ); ?>">Salgados de festas</a></li>
				<li class="bobounce"><a class="tortasDoces" href="<?php echo get_category_link( 1 ); ?>">Tortas doces</a></li>
				<li class="bobounce"><a class="tortasSalgadas" href="<?php echo get_category_link( 5 ); ?>">Tortas salgadas</a></li>
				<li class="bobounce"><a class="kit" href="<?php echo get_category_link( 6 ); ?>">Kit festa</a></li>
			</ul>
			<a id="ver-cardapio" href="<?php echo get_post_type_archive_link( 'produtos' ); ?>">Ver cardápio completo</a>
		</div>
	</section>

	<section class="tela" id="sobre">
		<div class="central">
		<h1>Sobre</h1>
			<div class="simpleTabs">
				<ul class="simpleTabsNavigation">
					<li><a href="#">História</a></li>
					<li><a href="#">Missão</a></li>
					<li><a href="#">Valores</a></li>
					<li><a href="#">Princípios</a></li>
				</ul>
				<?php $sobre = get_page_by_title("Sobre"); echo apply_filters("the_content", $sobre->post_content); ?>
			</div>

			<div class="sobreDireita">

				<div class="textos">
					<h2>#bocadoforno</h2>
					<p>Participar é simples. Basta postar uma foto no instagram com a hashtag #bocadoforno.</p>
				</div>
					<?php echo do_shortcode('[si_feed tag="bocadoforno" size="small" limit=4]'); ?>

				<?php extra(); ?>
			</div>

		</div>
	</section>


	<section class="tela" id="mapa">
		<ul id="locais">
		<h1>Lojas</h1>
			<li><a href="javascript:clicarNoMenu(1);">item 1</a></li>
			<li><a href="javascript:clicarNoMenu(2);">item 2</a></li>
			<li><a href="javascript:clicarNoMenu(3);">item 3</a></li>
			<li><a href="javascript:clicarNoMenu(4);">item 4</a></li>
			<li><a href="javascript:clicarNoMenu(5);">item 5</a></li>
			<li><a href="javascript:clicarNoMenu(6);">item 6</a></li>
			<li><a href="javascript:clicarNoMenu(7);">item 7</a></li>
		</ul>

		<div id="innerMapa"></div>
	</section>


	<section class="tela" id="contato">
		<div class="central">
			<h1>Contato</h1>

			<div class="fb-like-box" data-href="https://www.facebook.com/bocadofornooficial" data-width="380" data-height="480" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="true"></div>
			<div id="formContato"><?php echo FrmFormsController::show_form(6, $key='', $title=true, $description=true); ?></div>

		</div>
	</section>

	<!-- /blocos -->

<?php get_footer(); ?>