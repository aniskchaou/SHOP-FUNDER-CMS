<?php
/**
 * Brands Carousel
 *
 * @author 		Transvelo
 * @package 	Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php if ( empty ( $link ) ) : ?>
<div class="team-member <?php echo esc_attr( $display_style ); ?>">
<?php else : ?>
<a href="<?php echo esc_url( $link ); ?>" class="team-member <?php echo esc_attr( $display_style ); ?>">
<?php endif; ?>
	<?php echo wp_get_attachment_image( $profile_pic, 'full', false, array( 'class' => 'profile-pic img-responsive' ) ); ?>
	<div class="profile">
		<h3><?php echo esc_html( $title ); ?> <small class="description"><?php echo esc_html( $designation ); ?></small></h3>
	</div>
<?php if ( empty ( $link ) ) : ?>
</div>
<?php else : ?>
</a>
<?php endif; ?>