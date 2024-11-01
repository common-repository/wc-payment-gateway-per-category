<?php
/**
 * Plugin Name: Woocommerce Payment Gateway Per Category
 * Plugin URI: http://www.dreamfoxmedia.com/project/woocommerce-payment-gateway-per-category-free/ 
 * Version: 2.0.10
 * Author: Dreamfox Media
 * Author URI: www.dreamfoxmedia.com 
 * Description: Extend Woocommerce plugin to add payments methods to a Category
 * Requires at least: 4.5
 * Tested up to: 5.2
 * WC requires at least: 3.0.0
 * WC tested up to: 3.6.2
 * Text Domain: softdev
 * Domain Path: /languages
 * @Developer : Anand Rathi / Marco van Loghum Slaterus
 */
if ( !function_exists( 'is_plugin_active_for_network' ) || !function_exists( 'is_plugin_active' ) ) {
require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
if (is_plugin_active('woocommerce/woocommerce.php')) {
    add_action('admin_enqueue_scripts', 'dreamfox_category_payments_enqueue_free');
    add_action('admin_menu', 'dreamfox_category_payments_submenu_page_free');

    /**
     * 
     */
    function dreamfox_category_payments_enqueue_free() {
        wp_enqueue_style('softsdev_pd_payments_enqueue', plugin_dir_url(__FILE__) . '/css/style.css');
    }

    /**
     * 
     */
    function dreamfox_category_payments_submenu_page_free() {
        add_submenu_page('woocommerce', __('Category Payments Free', 'softsdev'), __('Category Payments Free', 'softsdev'), 'manage_options', 'softsdev-category-payments-free', 'dreamfox_category_payments_settings_free');
    }

    require_once dirname( __FILE__ ).'/includes/footer.php';

    require_once dirname( __FILE__ ).'/includes/payment_settings.php';

    require_once dirname( __FILE__ ).'/includes/plugin_settings.php';
    
    require_once dirname( __FILE__ ).'/includes/gateways.php';
    
    require_once dirname( __FILE__ ).'/includes/payment_fields.php';
    
    require_once dirname( __FILE__ ).'/includes/payment_form.php';

}

/**
 * Type: updated,error,update-nag
 */
if (!function_exists('softsdev_notice')) {

    function softsdev_notice($message, $type) {
        $html = <<<EOD
<div class="{$type} notice">
<p>{$message}</p>
</div>
EOD;
        echo $html;
    }

}
?>