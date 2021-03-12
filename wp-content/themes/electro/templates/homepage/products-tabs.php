<?php
/**
 * Products Carousel Tab
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section_class = 'products-carousel-tabs';

if ( ! empty( $animation ) ) {
	$section_class .= ' animate-in-view';
}

$tab_uniqid = 'home-tab-' . uniqid();

?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ): ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
	
	<ul class="nav nav-inline">

	<?php 
	
	foreach( $args['tabs'] as $key => $tab ) {

		$tab_id = ! empty( $tab['id'] ) ? $tab['id'] : $tab_uniqid . '-' . $key;
	
	?>
		<li class="nav-item">
			<a class="nav-link<?php if ( $key == 0 ) echo esc_attr( ' active' ); ?>" href="#<?php echo esc_attr( $tab_id ); ?>" data-toggle="tab">
				<?php echo wp_kses_post ( $tab['title'] ); ?>
			</a>
		</li>
	
	<?php }	?>

	</ul>

	<div class="tab-content">
		
		<?php 

		foreach( $args['tabs'] as $key => $tab ) : 

			$tab_id = ! empty( $tab['id'] ) ? $tab['id'] : $tab_uniqid . '-' . $key;
		?>

		<div class="tab-pane <?php if ( $key == 0 ) echo esc_attr( 'active' ); ?>" id="<?php echo esc_attr( $tab_id ); ?>" role="tabpanel">

		<?php
			$default_atts 	= array( 
				'per_page' => intval( $args['limit'] ), 
				'columns'  => intval( $args['columns'] ),
			);

			if ( electro_is_wide_enabled() ) {
				$default_atts['columns_wide'] = intval( $args['columns_wide'] );
			}
			$atts 			= isset( $tab['atts'] ) ? $tab['atts'] : array();
			$atts 			= wp_parse_args( $atts, $default_atts );

			echo electro_do_shortcode( $tab['shortcode_tag'],  $atts );
		?>
		</div>
		
		<?php endforeach; ?>

	</div>
</div>