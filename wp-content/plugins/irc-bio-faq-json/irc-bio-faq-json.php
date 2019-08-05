<?php
/**
 * Plugin Name: Irc Bio FAQ page JSON
 * Description: Add json to head
 * Version: 1.0
 * Author: Michael Chizhevsky
 * Text Domain: irc-bio
 */

// If this file is called directly, abort.
if ( ! defined('WPINC' ) ) {
    die;
}

// Setup
define( 'AMH_PLUGIN_URL', __FILE__ );

// Includes
include( 'inc/add-settings.php' );
include( 'process/add-json-to-head.php' );

add_action( 'save_post', 'bio_save_post_admin', 10, 3 );
function bio_save_post_admin($post_id, $post, $update ){
    if(!$update){
        return;
    }
    if($post_id == get_option('faq_page')){
        // Get data
        $content = $post->post_content;

        $regexp = '/(?:spb_accordion_tab title=")(.*)(?:" accordion_id)(?:.*])([\s\S]*?\[)/';
        $result = preg_match_all($regexp, $content, $match);

        $faqData = [];

        foreach ($match[1] as $key => $question){
            $faqData[$key]['question'] = trim($question);
            $faqData[$key]['answer']   = substr( trim($match[2][$key]), 0, -1);
        }

        update_post_meta( $post_id, 'faq_data_json', $faqData );
    }

}

