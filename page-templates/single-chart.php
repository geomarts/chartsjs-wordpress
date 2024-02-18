<?php
/*
Template Name: Single Chart Page
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
					<canvas id="myChart"></canvas>
				</div>
			</article>
			<?php
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
