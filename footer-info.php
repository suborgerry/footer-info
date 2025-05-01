<?php
/*
Plugin Name: Footer Info
Description: Create and update your contact info in footer
Version: 1.1
Author: borgerry
*/

define('FI_PLUGIN_PATH', plugin_dir_path(__FILE__));

require_once FI_PLUGIN_PATH . 'inc/settings-page.php';
require_once FI_PLUGIN_PATH . 'inc/fields.php';
require_once FI_PLUGIN_PATH . 'inc/display.php';
require_once FI_PLUGIN_PATH . 'inc/validation.php';

add_action('wp_enqueue_scripts', 'fi_enqueue_styles');
function fi_enqueue_styles() {
    wp_enqueue_style(
        'fi-footer-style',
        plugin_dir_url(__FILE__) . 'styles/styles.css',
        array(),
        '1.0'
    );
}

add_action('admin_enqueue_scripts', 'fi_enqueue_scripts');
function fi_enqueue_scripts() {
    wp_enqueue_script(
        'fi-script',
        plugin_dir_url(__FILE__) . 'js/validator.js',
        array('jquery'),
        '1.0',
        true
    );
}