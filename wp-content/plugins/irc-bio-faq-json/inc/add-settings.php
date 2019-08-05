<?php
function add_option_select_faq_page_admin_page(){
    $option_name = 'faq_page';


    register_setting( 'general', $option_name );


    add_settings_field(
        'faq_setting-id',
        'Select FAQ page',
        'faq_setting_callback_function',
        'general',
        'default',
        array(
            'id' => 'faq_setting-id',
            'option_name' => 'faq_page'
        )
    );
}
add_action('admin_menu', 'add_option_select_faq_page_admin_page');

function faq_setting_callback_function( $val ){

    $option_name = $val['option_name'];
    wp_dropdown_pages( array(
        'name' => $option_name,
        'show_option_none' => __( '— Select —' ),
        'option_none_value' => '0',
        'selected' => get_option($option_name),
    ));

}