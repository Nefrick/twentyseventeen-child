<?php

function admin_menu_hide() {
    add_menu_page('Admin menu hide', 'Hide Menu Item', 'manage_options', 'hide-menu-item', 'amh_plugin_page','dashicons-menu', 99);
}

function amh_plugin_page(){
echo "<h1>Спрятать пункты меню</h1>";
$menu_items = $GLOBALS['menu'];

echo '<form method="post" action="" id="amh-form">';
    $get_option = get_option('hidden_admin_menu_items');

    foreach ($menu_items as $item ){

    if( $item[0] == '' || $item[2] == 'hide-menu-item' ) continue;
    list($title, $trash ) = explode("<", $item[0]);
    if( is_array($get_option)){

        $checked  = in_array( $item[5] ,$get_option ) ? 'checked="checked"' : '';
    }
    echo '<input type="checkbox" name="amh_'.trim(strtolower($title)).'" value="'.$item[5].'" '.$checked.'>'.$title.'<br>';
    }
    echo '<button class="btn" type="submit"  id="save-admin-menu-items">Save</button>';

    echo '</form>';

}
add_action('admin_menu', 'admin_menu_hide');