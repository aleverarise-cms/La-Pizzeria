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
	
<?php get_footer() ?>