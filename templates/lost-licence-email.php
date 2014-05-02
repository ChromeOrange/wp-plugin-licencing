<?php
/**
 * Lost licence email
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php _e( "Your licence keys are as follows:", 'wp-plugin-licencing' ); ?></p>

<ul>
	<?php foreach ( $keys as $key ) : $api_product = wppl_get_licence_product( $key->product_id ); ?>
		<li>
			<?php echo esc_html( $api_product->post_title ); ?>: <strong><?php echo $key->licence_key; ?></strong>
			<?php
				if ( $api_product_permissions = wppl_get_licence_api_product_permissions( $key->product_id ) ) {
					echo '<ul class="digital-downloads">';
					foreach ( $api_product_permissions as $api_product_permission ) {
						echo '<li><a class="download-button" href="' . wppl_get_package_download_url( $api_product_permission, $key->licence_key, $key->activation_email ) . '">' . sprintf( __( 'Download %s', 'wp-plugin-licencing' ), get_the_title( $api_product_permission ) ) . '</a></li>';
					}
					echo '</ul>';
				}
			?>
		</li>
	<?php endforeach; ?>
</ul>

<?php do_action( 'woocommerce_email_footer' ); ?>