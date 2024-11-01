<?php

/**
 * 
 * @global type $post
 * @global WC_Payment_Gateways $woo
 */
function wcp_cateory_payments_form_free($category) {
    global $post, $woo, $wpdb;
    $softsdev_wpp_plugin_settings = get_option('sdwcp_plugin_free_settings', '');
    $sql = "SELECT term_id FROM $wpdb->termmeta WHERE meta_key = 'softsdev_payment_categories_free' ";
    if ($softsdev_wpp_plugin_settings != $category->term_id) {
        return;
    }

    $cateogry_payments = array();
    $cateogry_payments = unserialize(get_term_meta($category->term_id, 'softsdev_payment_categories_free', true));
    ?>

    <tr class="holyday_range">
        <th>
            <label><?php echo __('Category Payment', 'softsdev') ?></label>

        </th>
        <td>            

            <?php
            $productIds = get_option('woocommerce_product_apply', array());
            if (is_array($productIds)) {
                foreach ($productIds as $key => $product) {
                    if (!get_post($product) || !count(get_post_meta($product, 'payments', true))) {
                        unset($productIds[$key]);
                    }
                }
            }
            update_option('woocommerce_product_apply', $productIds);

            $woo = new WC_Payment_Gateways();
            //$payments = $woo->get_available_payment_gateways();
            $payments = $woo->payment_gateways;
            foreach ($payments as $pay) {
                if (apply_filters('softsdev_show_disabled_gateways', false) || $pay->enabled === 'no') {
                    continue;
                }
                $checked = '';
                if ($cateogry_payments && in_array($pay->id, $cateogry_payments)) {
                    $checked = ' checked="yes" ';
                }
                ?>  
                <input type="checkbox" <?php echo $checked; ?> value="<?php echo $pay->id; ?>" name="pays[]" id="payment_<?php echo $pay->id; ?>" />
                <label for="payment_<?php echo $pay->id; ?>"><?php echo $pay->title; ?></label>  
                <br />  
                <?php
            }
            ?>

        </td>
    </tr>
    <?php
}

add_action('product_cat_edit_form_fields', 'wcp_cateory_payments_form_free');