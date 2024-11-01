<?php

/**
 * 
 * @global type $woocommerce
 * @param type $available_gateways
 * @return type
 */
function wcppayment_gateway_available_free($available_gateways) {
    global $woocommerce;
    $arrayKeys = array_keys($available_gateways);

    /**
     * checking all cart products
     */
    if (is_object($woocommerce->cart)) {
        $items = $woocommerce->cart->cart_contents;
        $itemsPays = '';
        if (is_array($items)) {
            foreach ($items as $item) {
                $term_list = wp_get_post_terms($item['product_id'], 'product_cat', array('fields' => 'ids'));
                if (!$term_list)
                    continue; //in case of no categories assigned to this product
                foreach ($term_list as $term_id) {
                    $cateogry_payments = unserialize(get_term_meta($term_id, 'softsdev_payment_categories_free', true));
                    //in case of no payments assigned to this category, then we unset all the available payments
                    if (!$cateogry_payments) {
                        continue;
                    }
                    $diff = array_diff($arrayKeys, $cateogry_payments);
                    if (!$diff)
                        continue;
                    foreach ($diff as $remove_payment) {
                        unset($available_gateways[$remove_payment]);
                    }
                }
            }

            //fallback case if there are gateways avaialble
            if (!$available_gateways) {
                return $available_gateways;
            }
        }
    }
    return $available_gateways;
}

add_filter('woocommerce_available_payment_gateways', 'wcppayment_gateway_available_free');


add_action('edited_product_cat', 'dreamfox_save_category_payment_fields_free');