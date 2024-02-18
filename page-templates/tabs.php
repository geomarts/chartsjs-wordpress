<?php
/*
Template Name: Tabs Page
*/
get_header();
?>

<main class="site-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			$tabs = get_field( 'tabs' );
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="container my-5">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<?php
						foreach ( $tabs as $key => $tab ) :
							$active_class  = 0 === $key ? ' active' : '';
							$aria_selected = 0 === $key ? true : false;
							$number        = ++$key;
							?>
							<li class="nav-item" role="presentation">
								<button class="nav-link<?php echo $active_class; ?>" id="chart<?php echo $number; ?>-tab" data-bs-toggle="tab" data-bs-target="#chart<?php echo $number; ?>-tab-pane" type="button" role="tab" aria-controls="chart<?php echo $number; ?>-tab-pane" aria-selected="<?php echo $aria_selected; ?>">
									<?php echo esc_html( $tab['title'] ); ?>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="tab-content mt-5" id="myTabContent">
						<?php
						foreach ( $tabs as $key => $tab ) :
							$active_class = 0 === $key ? ' show active' : '';
							$number       = ++$key;
							?>
							<div class="tab-pane fade<?php echo $active_class; ?>" id="chart<?php echo $number; ?>-tab-pane" role="tabpanel" aria-labelledby="chart<?php echo $number; ?>-tab" tabindex="0">
								<canvas id="myChart<?php echo $number; ?>"></canvas>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</article>
			<?php
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
