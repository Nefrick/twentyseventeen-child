<?php
add_action( 'wp_ajax_save_hide_menu_item_action', 'save_hide_menu_item_action' );

function save_hide_menu_item_action() {

    check_ajax_referer( 'special-security-action', 'security' );

    $items = array();

    parse_str($_POST['data'], $items);

    update_option( 'hidden_admin_menu_items', $items );

    wp_die();
}