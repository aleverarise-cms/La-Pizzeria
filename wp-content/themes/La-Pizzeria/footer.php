	
	<footer>
		<?php

			$arg = array(
				'theme_location' => 'header-menu', 
				'container' => 'nav', 
				'after' => '<span class="separador"> | </span>', 
			);

			wp_nav_menu($arg);

		?>

		<div class="ubicacion">
			<p><?= esc_html(get_option('lapizzeria_direccion')) ?></p>
			<p><?= esc_html(get_option('lapizzeria_telefono')) ?></p>
		</div>

		<p class="copyright">Todos los derechos reservados <?= date('Y') ?></p>
	</footer>



		<?php wp_footer() ?>
	</body>
</html>