<?php

// inc

include 'init/exchange-rates.php';

// Action & Filters

// Add Scripts
add_action( 'wp_enqueue_scripts', function (){
    wp_register_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_register_style( 'child-style', get_locale_stylesheet_uri() );

    wp_enqueue_style( 'parent-style' );
    wp_enqueue_style( 'child-style' );
});

// Change number or products per row to 2
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 2; // 2 products per row
    }
}

// Filter price and symbol

add_filter( 'woocommerce_get_price', 'ex_convert_price', 10, 2 );
function ex_convert_price( $price, $product ) {

    $currency       = get_option('wc_settings_currency_selection');
    $euro_course    = get_option('wc_settings_exchange_rates_euro');

    if ( $currency == 'uah' )
        return $price;

    if ( $currency == 'euro' ) {
         $price = (float)$price / (float)$euro_course;
    }
    return $price;

}

add_filter( 'woocommerce_format_sale_price', 'ex_convert_sale_price', 20, 3 );
function ex_convert_sale_price( $price, $regular_price, $sale_price ) {

    $currency       = get_option('wc_settings_currency_selection');
    $euro_course    = get_option('wc_settings_exchange_rates_euro');


    if ( $currency == 'uah' )
        return sprintf( '<span class="sale_price">%s</span> <span class="rrp"> %s</span>',
            wc_price( $sale_price  ), wc_price( $regular_price ) );

    if ( $currency == 'euro' ) {
        return sprintf( '<span class="sale_price">%s</span> <span class="rrp"> %s</span>',
            wc_price( $sale_price  ), wc_price( $regular_price / (float)$euro_course ) );
    }

}

add_filter('woocommerce_currency_symbol', 'add_euro_currency_symbol', 999, 2);
function add_euro_currency_symbol( $symbol, $code ) {
    $currency       = get_option('wc_settings_currency_selection');
    if( $code == 'UAH' && $currency == 'euro' ) {
        return  '<span class="euro">€ </span>';
    }
    return $symbol;
}