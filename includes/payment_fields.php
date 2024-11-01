<?php

/**
 * 
 * @param type $term_id
 * @return type
 */
function dreamfox_save_category_payment_fields_free($term_id) {
    $softsdev_wpp_plugin_settings = get_option('sdwcp_plugin_free_settings', '');

    if ($softsdev_wpp_plugin_settings != $term_id) {
        delete_woocommerce_term_meta($term_id, 'softsdev_payment_categories_free');
        return;
    }

    update_woocommerce_term_meta($term_id, 'softsdev_payment_categories_free', serialize($_POST['pays']));
}
