<?php
/**
 * Plugin Name: Qaisar Satti Hide Add To Cart
 * Plugin URI: https://store.qaisarsatti.com
 * Description: Hide Add to cart for not logged in 
 * Version: 1.0.0
 * Text Domain: Qaisar Satti Store
 * Author: Qaisar Satti
 * Author URI: https://store.qaisarsatti.com
 */
 if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
	function qaisarsatti_hideaddtocart_admin_notice() {
		$qhideaddtocart_allowed_tags = array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'b' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'strong' => array(),
		);
		// Deactivate the plugin
		deactivate_plugins(__FILE__);
		$qhideaddtocart_woo_check = '<div id="message" class="error">
			<p><strong>Hide Price plugin is inactive.</strong> The <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a> must be active for this plugin to work. Please install &amp; activate WooCommerce »</p></div>';
		echo wp_kses( __( $qhideaddtocart_woo_check, 'qaisarsatti-hidepaddtocart' ), $qhideaddtocart_allowed_tags);
	}
		add_action('admin_notices', 'qaisarsatti_hideaddtocart_admin_notice');

			

}

add_filter('woocommerce_get_price_html','qaisarsatti_hideaddtocart');
function qaisarsatti_hideaddtocart( $priceHtml ) {			
	if(is_user_logged_in() ){
    return $priceHtml;
  }
  else {

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    return $priceHtml;
  }
}