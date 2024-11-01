<?php

/**
 * 
 */
function dreamfox_category_payments_settings_free() {
    add_filter('admin_footer_text', 'dreamfox_category_payments_footer_text_free');
    add_filter('update_footer', 'dreamfox_category_payments_update_footer_free');

    $pluginurl = plugin_dir_url(__FILE__);
    $user = wp_get_current_user(); 
    
    echo '<div class="left-mc-setting">';
    echo '<h1>' . __('Woocommerce Payment Gateway per Category', 'softsdev') . '</h1>';
    
            require_once dirname( __FILE__ ).'/../templates/brief-plugin.phtml'; 
    				dreamfox_sdwcp_free_plugin_settings(); 
            require_once dirname( __FILE__ ).'/../templates/help-plugin.phtml';

		echo '</div><div class="right-mc-setting">';

            require_once dirname( __FILE__ ).'/../templates/buynow.phtml';
            require_once dirname( __FILE__ ).'/../templates/subscribe.phtml';
            require_once dirname( __FILE__ ).'/../templates/donate.phtml';

		echo '</div>';
}