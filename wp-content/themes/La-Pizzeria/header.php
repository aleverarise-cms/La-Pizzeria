<!DOCTYPE html>
<html>
<head>
	<title><?= bloginfo('name') ?><?php wp_title('|', true, 'left'); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<!-- IOS -->
	<meta name="apple-mobil-web-app-capable" content="yes">
	<meta name="apple-mobil-web-app-title" content="La Pizzeria">
	<link rel="apple-touch-icon" href="<?= get_template_directory_uri() ?>/img/logo.svg" >

	<!-- ANDROID -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="#a61206">
	<meta name="aplication-name" content="La Pizzeria">
	<link rel="icon" type="image/png" href="<?= get_template_directory_uri() ?>/img/logo.svg" sizes="192x192">

	<?php wp_head() ?>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<body <?= body_class() ?>>

	<header id="header" class="encabezado-sitio">
		<!-- contenedor -->
		<div class="contenedor">
			<!-- logo -->
			<div class="logo">
				<a href="<?= esc_url(home_url('/')) ?>">
					<?php 

						if (function_exists('the_custom_logo')) {
							the_custom_logo();
						}

					?>
				</a>
			</div>
			<!-- fin logo -->
			<div class="informacion-encabezado">
				<!-- redes-sociales -->
				<div class="redes-sociales">
					<?php
						$arg = array(
							'theme_location' => 'social-menu',
							'container' => 'nav',
							'container_class' => 'menu-social',
							'container_id' => 'sociales',
							'link_before' => '<span class="sr-text">',
							'link_after' => '</span>'
						);

						wp_nav_menu($arg);
					?>
				</div>
				<!-- fin redes-sociales -->
				<div class="direccion">
					<p><?= esc_html(get_option('lapizzeria_direccion')) ?></p>
					<p><?= esc_html(get_option('lapizzeria_telefono')) ?></p>
				</div>
			</div>
		</div>
		<!-- fin contenedor -->
	</header><!-- /header -->

	<div class="menu-principal">

		<div class="mobile-menu">
			<a href="#" class="mobile"><i class="fas fa-bars"></i> Menu</a>
		</div>

		<div class="contenedor navegacion">
			<?php 

				$arg = array(
					'theme_location' => 'header-menu',
					'container' => 'nav',
					'container_class' => 'menu-sitio',
				);

				wp_nav_menu($arg);

			?>
		</div>
	</div>

