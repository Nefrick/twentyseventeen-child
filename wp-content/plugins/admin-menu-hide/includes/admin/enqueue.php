<?php

function js_admin_enqueue(){
    if(!isset($_GET['page']) || $_GET['page'] != 'hide-menu-item'){
        return;
    }

    wp_register_script('amh_js_enqueue', plugins_url('/assets/js/admin/amh-script.js', AMH_PLUGIN_URL ));
    wp_localize_script('amh_js_enqueue', 'amhObj', array(
        'ajax_url'          =>  admin_url('admin-ajax.php'),
        'security'          =>  wp_create_nonce( "special-security-action" ),
        'action'            =>  'save_hide_menu_item_action'
    ));
    wp_enqueue_script('amh_js_enqueue');
}

add_filter( 'admin_footer', 'js_admin_enqueue' );