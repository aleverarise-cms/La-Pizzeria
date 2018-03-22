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

		<div class="informacion-cajas contenedor">
			<div class="caja">
				<?php 
					$id_imagen = get_field('imagen_1');
					$imagen = wp_get_attachment_image_src($id_imagen, 'nosotros')
				?>
				<img src="<?= $imagen[0] ?>" class="imagen-caja" alt="">
				<div class="contenido-caja">
					<?= the_field('descripcion_1') ?>
				</div>
			</div>
			<div class="caja">
				<?php 
					$id_imagen = get_field('imagen_2');
					$imagen = wp_get_attachment_image_src($id_imagen, 'nosotros')
				?>
				<img src="<?= $imagen[0] ?>" class="imagen-caja" alt="">
				<div class="contenido-caja">
					<?= the_field('descripcion_2') ?>
				</div>
			</div>
			<div class="caja">
				<?php 
					$id_imagen = get_field('imagen_3');
					$imagen = wp_get_attachment_image_src($id_imagen, 'nosotros')
				?>
				<img src="<?= $imagen[0] ?>" class="imagen-caja" alt="">
				<div class="contenido-caja">
					<?= the_field('descripcion_3') ?>
				</div>
			</div>
		</div>
	<?php } ?>
	
<?php get_footer() ?>