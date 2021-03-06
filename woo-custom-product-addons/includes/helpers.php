<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




if (!function_exists('wcpa_get_option')) {

    /**
     * @return string
     */
     function wcpa_get_option($option, $default = false, $translate = false) {
        $settings = get_option(WCPA_SETTINGS_KEY);

        $settings = apply_filters('wcpa_configurations', $settings);
        $response = isset($settings[$option]) ? $settings[$option] : $default;
        if ($translate) { 
            if (function_exists('pll__')) {
                return pll__($response);
            } else {
                return __($response, 'wcpa-text-domain');
            }
        }
        return $response;
    }

}

if (!function_exists('get_wcpa_display_hook')) {
    function get_wcpa_display_hook($arg)
    {
        $hooks = apply_filters('wcpa_display_hooks', [
            "fields" => ["woocommerce_before_add_to_cart_button", 10]
        ]);
        return $hooks[$arg];
    }


}

if (!function_exists('wcpa_empty')) {

    /**
     * @return string
     */
    function wcpa_empty($var) {
        if (is_array($var)) {
            return empty($var);
        } else {
            return ($var === null || $var === false || $var === '');
        }
    }

}

if (!function_exists('wcpa_is_wcpa_product')) {

    /**
     * @return string
     */
    function wcpa_is_wcpa_product($product_id)
    {

        $form = new WCPA_Form();
        $products = $form->get_wcpa_products();
        if(is_array($products)){
            return in_array($product_id, $products);
        }else{
            return false;
        }


    }

}