<?php

/**
* Setting form
*/
function dreamfox_sdwcp_free_plugin_settings() {
/**
    * Settings default
    */
if (isset($_POST['sdwcp_setting_free'])) {
    $old_softsdev_wpp_plugin_settings = get_option('sdwcp_plugin_free_settings', '');
    update_option('sdwcp_plugin_free_settings', sanitize_text_field($_POST['sdwcp_setting_free']));
    softsdev_notice('Default Category updated for which payment method selection will be enabled.', 'updated');

    if ($old_softsdev_wpp_plugin_settings != '' && $old_softsdev_wpp_plugin_settings != sanitize_text_field($_POST['sdwcp_setting_free'])) {
        delete_woocommerce_term_meta($old_softsdev_wpp_plugin_settings, 'softsdev_payment_categories_free');
    }
}
$softsdev_wpp_plugin_settings = get_option('sdwcp_plugin_free_settings', '');


$args = array(
    'hide_empty' => 0,
    'orderby' => 'slug',
    'order' => 'ASC',
);
$product_categories = get_terms('product_cat', $args);

//print_r($product_categories); exit;
?>
<form id="woo_sdwpp" action="<?php echo $_SERVER['PHP_SELF'] . '?page=softsdev-category-payments-free' ?>" method="post">
    <div class="postbox " style="padding: 10px 0; margin: 10px 0px;">


        <h3 class="hndle"><?php echo __('Default Category for which payment method selection enabled.', 'softsdev'); ?></h3>
        <select id="sdwpp_default_payment" name="sdwcp_setting_free">
            <option value="">None</option>
            <?php
            foreach ($product_categories as $category) {

                echo "<option value = '" . $category->term_id . "' " . selected($softsdev_wpp_plugin_settings, $category->term_id) . ">" . $category->name . "</option>";
            }
            ?>
        </select>
        <br />
        <br><small>You can select ONLY ONE categories. If you want more categories then use our premium version:<br><a href="https://www.dreamfoxmedia.com/portfolio/woocommerce-payment-gateway-per-category-premium?utm_source=plugin&utm_medium=brief_plugin_link&utm_campaign=dfm-wcpgpp-f" target="_blank">https://www.dreamfoxmedia.com/portfolio/woocommerce-payment-gateway-per-category-premium/</a></small>
                    
    </div>
    <input class="button-large button-primary" type="submit" value="Save changes" />
</form>  <?php
}