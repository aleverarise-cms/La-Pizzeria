<?php 
/*
* Template Name: Especialidades
*/

?>

<?php get_header() ?>

	<?php
		while (have_posts()) {
		the_post();
	?>

		<div class="hero" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)">
			<div class="contenido-hero">
				<div class="texto-hero">
					<?= the_title('<h1>', '</h1>') ?>
				</div>
			</div>
		</div>

		<div class="principal contenedor">
			<main class="texto-centrado contenido-paginas">
				<?= the_content() ?>
			</main>
		</div>
	<?php } ?>

	<div class="nuestras-especialidades">
		<h3 class="texto-rojo">Pizzas</h3>

		<div class="contenedor-grid">
			
			<?php

				$arg = array(
					'post_type' => 'especialidades', 
					'posts_per_page' => -1, 
					'orderby' => 'title', 
					'order' => 'ASC', 
					'category_name' => 'pizzas', 
				);
				$pizzas = new WP_Query($arg);

				while ($pizzas->have_posts()) {
					$pizzas->the_post();
			?>	

				<div class="columnas2-4">
					<?= the_post_thumbnail('especialidades'); ?>
					<div class="texto-especialidad">
						<h4><?= the_title() ?> <span><?= the_field('precio') ?></span></h4>
						<?= the_content() ?>
					</div>
				</div>

			<?php 
				}
				wp_reset_postdata();
			?>
		</div>

		<h3 class="texto-rojo">Otros</h3>
		<div class="contenedor-grid">
			
			<?php

				$arg = array(
					'post_type' => 'especialidades', 
					'posts_per_page' => -1, 
					'orderby' => 'title', 
					'order' => 'ASC', 
					'category_name' => 'otros', 
				);
				$otros = new WP_Query($arg);

				while ($otros->have_posts()) {
					$otros->the_post();
			?>	

				<div class="columnas2-4">
					<?= the_post_thumbnail('especialidades'); ?>
					<div class="texto-especialidad">
						<h4><?= the_title() ?> <span><?= the_field('precio') ?></span></h4>
						<?= the_content() ?>
					</div>
				</div>

			<?php 
				}
				wp_reset_postdata();
			?>
		</div>
	</div>
	
<?php get_footer() ?>