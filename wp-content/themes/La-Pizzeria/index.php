<?php get_header() ?>

	<?php 
		$pagina_blog = get_option('page_for_posts');
		$imagen = get_post_thumbnail_id($pagina_blog);
		$imagen = wp_get_attachment_image_src($imagen, 'full');
	?>
	

		<div class="hero" style="background-image: url(<?= $imagen[0] ?>)">
			<div class="contenido-hero">
				<div class="texto-hero">
					<h1><?= get_the_title($pagina_blog ) ?></h1>
				</div>
			</div>
		</div>

		<div class="principal contenedor">
			<div class="contenedor-grid">
				<main class="columnas2-3 contenido-paginas">
					<?php
						while (have_posts()) {
						the_post();
					?>
						<article>
							<a href="<?= the_permalink() ?>" class="button rojo">
								<?= the_post_thumbnail('especialidades') ?>
							</a>
							<header class="informacion-entrada clear">
								<div class="fecha">
									<time>	
										<?= the_time('d') ?>
										<span><?= the_time('M') ?></span>
									</time>
								</div>

								<div class="titulo-entrada">
									<h2><?= the_title() ?></h2>
									<p class="autor">
										<i class="fas fa-user"></i>
										<span><?= the_author() ?></span>
									</p>
								</div>
							</header><!-- /header -->

							<div class="contenido-entrada">
								<?= the_excerpt() ?>
								<a href="<?= the_permalink() ?>" class="button button-rojo">Ver Mas</a>
							</div>
						</article>	
					<?php } ?>

					<div class="paginacion">
						<?php // paginate_links() ?>
						<div class="siguientes">
							<?= previous_posts_link('Atras') ?>
						</div>
						<div class="anteriores">
							<?= next_posts_link('Siguiente') ?>
						</div>
					</div>
				</main>

				<?= get_sidebar(); ?>
			</div>
		</div>
	
<?php get_footer() ?>