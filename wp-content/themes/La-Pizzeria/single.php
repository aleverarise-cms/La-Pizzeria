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

		<div class="contenedor comentarios">
			<?= comment_form() ?>
		</div>
		<div class="contenedor">
			<h3 class="texto-centrado">Comentarios</h3>
			<ul class="lista-comentarios">
				<?php 
					$comentarios = get_comments(array(
						'post_id' => $post->ID,
						'status' => 'approve',
					));

					wp_list_comments(array(
						'per_page' => 10,
						'reverse_top_level' => false,
					), $comentarios);
				?>
			</ul>
		</div>
	<?php } ?>
	
<?php get_footer() ?>