<?php get_header() ?>

	<?php
		while (have_posts()) {
		the_post();

		$url = get_page_by_title('Sobre Nosotros');
	?>
		<div class="hero" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)">
			<div class="contenido-hero">
				<div class="texto-hero">
					<h1><?= esc_html(bloginfo('description') ) ?></h1>
					<?= the_content() ?>
					<a href="<?= get_permalink($url->ID) ?>" class="button button-naranja">Leer mas</a>
				</div>
			</div>
		</div>
	<?php } ?>

		<div class="principal contenedor">
			<main class="contenedor-grid texto-centrado">
				<h2 class="rojo">Nuestras Especialidades</h2>
				<?php 

					$arg = array(
						'posts_per_page' => 3, 
						'orderby' => 'rand', 
						'post_type' => 'especialidades', 
						'category_name' => 'pizzas',
					);

					$especialidades = new WP_Query($arg);
					while ($especialidades->have_posts()) {
						$especialidades->the_post();
				?>

					<div class="especialidad columnas1-3">
						<div class="contenido-especialidad">
							<?= the_post_thumbnail('especialidades_portrait') ?>
							<div class="informacion-platillo">
								<h3><?= the_title() ?></h3>
								<?= the_content() ?>
								<p class="precio">
									<?= the_field('precio') ?>
								</p>
								<a href="<?= the_permalink() ?>" class="button">Leer mas</a>
							</div>
						</div>
					</div>

				<?php
					} wp_reset_postdata();
				?>
			</main>
		</div>

		<section class="ingredientes">
			<div class="contenedor">
				<div class="contenedor-grid">
					<?php
						while (have_posts()) {
						the_post();
					?>
						<div class="columnas2-4">
							<?= the_field('contenido') ?>
							<a href="<?= the_permalink() ?>" class="button">Leer mas</a>
						</div>
						<div class="columnas2-4 imagen">
							<img src="<?= the_field('imagen') ?>" alt="Imagen">
						</div>
					<?php
						}
					?>
				</div>
			</div>
		</section>

		<section class="contenedor">
			<h2 class="texto-rojo texto-centrado">
				Galeria de Imagenes
			</h2>
			<?php $url = get_page_by_title('Galeria'); ?>
			<?= get_post_gallery($url->ID) ?>
		</section>

		<section class="ubicacion-reservacion">
			<div class="contenedor">
				<div class="contenedor-grid">
					<div class="columnas2-4">
						<div id="mapa">
							
						</div>
					</div>
					<div class="columnas2-4">
						<?= get_template_part('templates/formulario', 'reservacion') ?>
					</div>
				</div>	
			</div>
		</section>
	
	
<?php get_footer() ?>

