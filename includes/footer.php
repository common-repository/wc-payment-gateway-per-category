<?php

/**
 * 
 * @param type $text
 * @return type
 */
function dreamfox_category_payments_footer_text_free($text) {
    if (isset($_GET['page']) && strpos(plugin_basename(wp_unslash($_GET['page'])), 'softsdev-category-payments-free') === 0) {
        $text = sprintf('If you enjoy using <strong>Woocommerce Payments Gateway per Category</strong>, please <a href="%s" target="_blank">leave us a ★★★★★ rating</a>. A <strong style="text-decoration: underline;">huge</strong> thank you in advance!', 'https://wordpress.org/support/view/plugin-reviews/woocommerce-category-payments');
    }
    return $text;
}

/**
 * 
 * @param string $text
 * @return string
 */
function dreamfox_category_payments_update_footer_free($text) {
    if (isset($_GET['page']) && strpos(plugin_basename(wp_unslash($_GET['page'])), 'softsdev-category-payments-free') === 0) {
        $text = 'Version 2.0.9';
    }
    return $text;
}
