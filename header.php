<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

        <script type="text/javascript" src="//use.typekit.net/mlz4yzm.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	</head>
	<body <?php body_class(); ?>>


	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=255552517964135&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>


		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner">

				<!-- nav -->

				<?php if (is_home()) { ?>

					<nav id="menu-fixo" class="nav" role="navigation">
							<ul id="menu-fixo-paginas">
								<li><a id="item-home" data-scroll href="#home">Início</a></li>
								<li><a id="item-cardapio" data-scroll href="#cardapio">Cardápio</a></li>
								<li><a id="item-sobre" data-scroll href="#sobre">Sobre</a></li>
								<li><a id="item-mapa" data-scroll href="#mapa">Lojas</a></li>
								<li><a id="item-trabalhe" data-scroll href="#contato">Trabalhe Conosco</a></li>
								<li><a id="item-contato" class="item-sem-linha" data-scroll href="#contato">Contato</a></li>
							</ul>

							<ul id="menu-fixo-redes">
								<li><a class="facebook" href="https://pt-br.facebook.com/bocadofornooficial">fb</a></li>
								<li><a class="twitter" href="https://twitter.com/bocadoforno">tw</a></li>
								<li><a class="YouTube" href="">yt</a></li>
							</ul>
					</nav>

				</header>

				<?php } else { ?>

				</header>

					<nav class="barraHome" id="menu-da-home">
							<ul id="menu-da-home-paginas">
								<li><a id="item-home" href="<?php echo home_url(); ?>">Início</a></li>
								<li><a id="item-cardapio" href="<?php echo home_url(); ?>#cardapio">Cardápio</a></li>
								<li><a id="item-sobre" href="<?php echo home_url(); ?>#sobre">Sobre</a></li>
								<li><a id="item-mapa" class="item-sem-linha" href="<?php echo home_url(); ?>#mapa">Lojas</a></li>
								<li>
									<a class="item-sem-linha logo" href="<?php echo home_url(); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="bobounce logo-img">
									</a>
								</li>
								<li><a class="item-contato" href="<?php echo home_url(); ?>#contato">Trabalhe Conosco</a></li>
								<li><a class="item-sem-linha item-contato" href="<?php echo home_url(); ?>#contato">Contato</a></li>
							</ul>
							<ul id="menu-da-home-redes">
								<li><a class="facebook" href="https://pt-br.facebook.com/bocadofornooficial">fb</a></li>
								<li><a class="twitter" href="https://twitter.com/bocadoforno">tw</a></li>
								<li><a class="YouTube" href="">yt</a></li>
							</ul>
					</nav>

				<?php } ?>

				<!-- /nav -->
