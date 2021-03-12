<?php
/**
 * Show a brands description when on a taxonomy page
 */

if ( $thumbnail ) {
	echo mas_wcbr_get_brand_thumbnail_image( $brand );
}

echo wpautop( wptexturize( term_description() ) );