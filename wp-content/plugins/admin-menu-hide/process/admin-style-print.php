<?php

add_action('admin_head', 'hide_admin_menu_items');

function hide_admin_menu_items() {

    $get_option = get_option('hidden_admin_menu_items');

    $style = '';

    foreach ( $get_option as $item ){
        $style .= 'ul#adminmenu li#'.$item.', ';
    }
    $style = substr($style, 0, -2);
print '<style>
    /*Стили в админку для скрытия пунктов меню*/
    '.$style.'{display:none;}
    
</style>';

}