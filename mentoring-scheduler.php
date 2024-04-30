<?php

//wp plugin

/**
 * Plugin Name: Mentoring session scheduler
 * Plugin URI: https://github.com/marciofao/menthoring-scheduler
 * Description: Plugin for scheduling mentoring sessions
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

add_filter( 'init', 'ms_check_submit');
function ms_check_submit() {
    if ( isset( $_POST['menthoring-scheduler'] ) ) {
        require_once('process-scheduler-submit.php');
    }
}

require_once('setup-widget.php');

function ms_enqueue_styles() {
   
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'ms_enqueue_styles');

