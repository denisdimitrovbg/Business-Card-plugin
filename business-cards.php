<?php

if (!defined('ABSPATH')) exit;
/*
    Plugin Name: Business cards
    Plugin URI: http://www.denis.bg
    description: Creating business cards plugin
    Version: 0.0.1
    Author: Denis
    Author URI: http://www.denis.bg

*/


function enqueueScriptsAndStyles()
{
    wp_enqueue_style('business-cards-plugin-styles', plugins_url('assets/styles.css', __FILE__));
    wp_enqueue_script('business-cards-plugin-scripts', plugins_url('assets/js/functions.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'enqueueScriptsAndStyles');

function create_postType()
{
    register_post_type('business-cards',
        array(
            'labels' => array(
                'name' => __('Business Cards'),
                'singular_name' => __('Business Card'),
                'add_new_item' => __('Add New Business Card'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'business-cards'),
            'supports' => array('title', 'thumbnail'),
            'menu_icon' => 'dashicons-images-alt2'

        )
    );

}

add_action('init', 'create_postType');

function adding_custom_meta_boxes()
{
    add_meta_box(
        'meta-box-business-cards',
        __('Business Cards'),
        'renderPage',
        'business-cards',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'adding_custom_meta_boxes');

function renderPage()
{
    include_once 'views/admin-page.php';

}



function save_meta_box($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;


    $fields = [
        'business-cards-admin-form',
        'bc-name',
        'bc-role',
        'bc-phone'
    ];

    foreach ($fields as $field) {


        if ((array_key_exists($field, $_POST))) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

add_action('save_post', 'save_meta_box');

function shortCodeAction()
{
    ob_start();
    include_once 'views/business-cards.php';
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode('business-cards-plugin', 'shortCodeAction');




function my_edit_business_cards_columns() {

    $columns = array(
        'image' => __( 'Image' ),
        'title' => __( 'Title' ),
        'date' => __( 'Date' )
    );
    return $columns;
}
add_filter( 'manage_edit-business-cards_columns', 'my_edit_business_cards_columns' ) ;


function smashing_business_cards_column( $column, $post_id ) {

    if ( 'image' === $column ) {
        echo get_the_post_thumbnail( $post_id, array(80, 80) );
    }
}
add_action( 'manage_posts_custom_column', 'smashing_business_cards_column', 10, 2);