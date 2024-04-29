<?php

//wp plugin

/**
 * Plugin Name: Menthoring session scheduler
 * Plugin URI: https://github.com/marciofao/menthoring-scheduler
 * Description: Plugin for scheduling menthoring sessions
 * Version: 0.0.1
 * Author: Marcio Fão
 * Author URI: https://github.com/marciofao
 * Text Domain: ms
 * @package  ms
 * */

 //Load template from  page
add_filter( 'page_template', 'ms_scheduler_page' );
function ms_scheduler_page( $page_template ){

    if ( get_page_template_slug() == 'page-scheduler.php' ) {
        $page_template = dirname( __FILE__ ) . '/page-scheduler.php';
    }
    return $page_template;
}

/**
 * Add "Scheduçer page" template to page attirbute template section.
 */
add_filter( 'theme_page_templates', 'msd_add_template_page_select', 10, 4 );
function msd_add_template_page_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template page to select dropdown 
    $post_templates['page-scheduler.php'] = __('Menthoring Scheduler');

    return $post_templates;
}

add_filter( 'init', 'ms_chsck_submit');
function ms_chsck_submit() {
    if ( isset( $_POST['menthoring-scheduler'] ) ) {
        require_once('process-scheduler-submit.php');
    }
}

require_once(plugin_dir_path(__FILE__).'widget-display-scheduled.php');


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function ms_mentoring_sessions_block_init() {
	register_block_type_from_metadata( __DIR__ . '/build' );
}
add_action( 'init', 'ms_mentoring_sessions_block_init' );
