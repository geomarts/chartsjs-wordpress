<?php
function playground_scripts_and_styles() {
	$theme_uri = get_template_directory_uri();
	wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'playground-style', $theme_uri . '/style.css' );
	wp_enqueue_script( 'chart', 'https://cdn.jsdelivr.net/npm/chart.js' );
	wp_enqueue_script( 'bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' );

	//single chart
	if ( is_page_template( 'page-templates/single-chart.php' ) ) :
		wp_enqueue_script( 'playground-script-single-chart', $theme_uri . '/assets/js/single-chart.js', array(), null, true );
		wp_localize_script(
			'playground-script-single-chart',
			'global_obj',
			array(
				'chart' => get_single_chart(),
			)
		);
	endif;

	//tabs with multiple charts
	if ( is_page_template( 'page-templates/tabs.php' ) ) :
		wp_enqueue_script( 'playground-script-multiple-charts', $theme_uri . '/assets/js/multiple-charts.js', array(), null, true );
		wp_localize_script(
			'playground-script-multiple-charts',
			'global_obj',
			array(
				'charts' => get_multiple_charts(),
			)
		);
	endif;
}
add_action( 'wp_enqueue_scripts', 'playground_scripts_and_styles' );

function get_single_chart() {
	$chart_single  = (object) array(
		'legends' => (object) array(),
		'labels'  => array(),
		'bars'    => (object) array(
			'bar1' => array(),
			'bar2' => array(),
		),
		'title'   => '',
	);
	$chart         = get_field( 'chart' );
	$chart_legends = $chart['legends'];

	$chart_single->title            = esc_html( $chart['title'] );
	$chart_single->legends->legend1 = esc_html( $chart_legends['legend1'] );
	$chart_single->legends->legend2 = esc_html( $chart_legends['legend2'] );

	foreach ( $chart['rows'] as $row ) :
		array_push( $chart_single->labels, esc_html( $row['label'] ) );
		array_push( $chart_single->bars->bar1, esc_html( $row['bar1'] ) );
		array_push( $chart_single->bars->bar2, esc_html( $row['bar2'] ) );
	endforeach;

	return $chart_single;
}

function get_multiple_charts() {
	$charts = array();
	$tabs   = get_field( 'tabs' );
	foreach ( $tabs as $tab ) :
		$chart_single  = (object) array(
			'legends' => (object) array(),
			'labels'  => array(),
			'bars'    => (object) array(
				'bar1' => array(),
				'bar2' => array(),
			),
			'title'   => '',
		);
		$chart         = $tab['chart'];
		$chart_legends = $chart['legends'];

		$chart_single->title            = esc_html( $chart['title'] );
		$chart_single->legends->legend1 = esc_html( $chart_legends['legend1'] );
		$chart_single->legends->legend2 = esc_html( $chart_legends['legend2'] );

		foreach ( $chart['rows'] as $row ) :
			array_push( $chart_single->labels, esc_html( $row['label'] ) );
			array_push( $chart_single->bars->bar1, esc_html( $row['bar1'] ) );
			array_push( $chart_single->bars->bar2, esc_html( $row['bar2'] ) );
		endforeach;
		array_push( $charts, $chart_single );
	endforeach;

	return $charts;
}
