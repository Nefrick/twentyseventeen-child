<?php

class WC_Settings_Exchange_Rates {

public static function init() {
    add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
    add_action( 'woocommerce_settings_tabs_settings_exchange_rates', __CLASS__ . '::settings_tab' );
    add_action( 'woocommerce_update_options_settings_exchange_rates', __CLASS__ . '::update_settings' );
}


public static function add_settings_tab( $settings_tabs ) {
    $settings_tabs['settings_exchange_rates'] = __( 'Exchange Rates', 'woocommerce-settings-exchange-rates' );
return $settings_tabs;
}

public static function settings_tab() {
    woocommerce_admin_fields( self::get_settings() );
}

public static function update_settings() {
    woocommerce_update_options( self::get_settings() );
}

public static function get_settings() {

    $html = file_get_contents("http://valuta.online.ua");
    preg_match_all('!<td valign="middle" class="td_right">\\s+?(.*)\\s+?</td>!', $html, $res);
    for ($i = 0; $i < count($res[0]); $i++) {
        $res[$i] = preg_replace("/[\s\n]/", "", $res[$i]);
    }
    $euroPurchase = $res[0][3];
    $euroSale     = $res[0][4];
    $euroNBU     = $res[0][5];

    $settings = array(
            'section_title' => array(
            'name'     => __( 'Exchange Rates', 'woocommerce-settings-exchange-rates' ),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_exchange_rates_section_title'
        ),
        'description' => array(
            'type'     => 'title',
            'name'     => __( 'EURO - https://valuta.online.ua/', 'woocommerce-settings-exchange-rates' ),
            'desc'     => __( 'Покупка '.$euroPurchase. ' Продажа '.$euroSale.' Курс НБУ '.$euroNBU.' ', 'woocommerce-settings-exchange-rates-euro' ),
            'id'       => 'wc_settings_exchange_rates_section_desc'
        ),
            'euro' => array(
            'name' => __( 'Euro exchange rate', 'woocommerce-settings-exchange-rates-euro' ),
            'type' => 'text',
            'id'   => 'wc_settings_exchange_rates_euro'
        ),
        'currency_selection' => array(
            'name'          => __('Select Currency', 'woocommerce-currency-selection'),
            'type'          => 'select',
            'id'            => 'wc_settings_currency_selection',
            'options' => array(
                'uah'       => __('Hryvnia', 'woocommerce'),
                'euro'          => __('Euro', 'woocommerce')
            ),
            'desc'          => 'Select currency for products'
        ),
            'section_end' => array(
            'type' => 'sectionend',
            'id' => 'wc_settings_exchange_rates_section_end'
        )
    );
return apply_filters( 'wc_settings_exchange_rates_settings', $settings );
}
}

WC_Settings_Exchange_Rates::init();

