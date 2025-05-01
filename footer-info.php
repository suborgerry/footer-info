<?php
/*
Plugin Name: Footer Info
Description: Create and update your contact info in footer
Version: 1.1
Author: borgerry
*/

add_action('admin_menu', function () {
    add_options_page(
        'Інформація в футері',
        'Інформація в футері',
        'manage_options',
        'footer-info',
        'fi_settings_page_form'
    );
});

function fi_settings_page_form()
{
    ?>
    <div class="wrap">
        <h1>Інформація в футері</h1>
        <form method="post" action="options.php" id="fi-form">
            <?php
            settings_fields('fi_settings_group');
            do_settings_sections('fi-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function fi_validate_phone($input) {
    return preg_match('/^\+380\d{9}$/', $input) ? $input : '';
}

add_action('admin_init', function () {
    register_setting('fi_settings_group', 'fi_phone', ['sanitize_callback' => 'fi_validate_phone']);
    register_setting('fi_settings_group', 'fi_email');
    register_setting('fi_settings_group', 'fi_address');
    register_setting('fi_settings_group', 'fi_hours');

    register_setting('fi_settings_group', 'fi_show_phone');
    register_setting('fi_settings_group', 'fi_show_email');
    register_setting('fi_settings_group', 'fi_show_address');
    register_setting('fi_settings_group', 'fi_show_hours');

    add_settings_section(
        'fi_main_section',
        'Налаштування контактної інформації',
        null,
        'fi-settings'
    );

    // Inputs
    add_settings_field('fi_phone', 'Номер телефону', 'fi_phone_field', 'fi-settings', 'fi_main_section');
    add_settings_field('fi_email', 'Email', 'fi_email_field', 'fi-settings', 'fi_main_section');
    add_settings_field('fi_address', 'Адреса', 'fi_address_field', 'fi-settings', 'fi_main_section');
    add_settings_field('fi_hours', 'Години роботи', 'fi_hours_field', 'fi-settings', 'fi_main_section');

    // Checkboxes
    add_settings_field('fi_show_phone', 'Показувати номер телефону?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_phone']);
    add_settings_field('fi_show_email', 'Показувати Email?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_email']);
    add_settings_field('fi_show_address', 'Показувати адресу?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_address']);
    add_settings_field('fi_show_hours', 'Показувати години роботи?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_hours']);
});

// Fields functions
function fi_phone_field() {
    $value = esc_attr(get_option('fi_phone', ''));
    echo '<input type="tel" name="fi_phone" id="fi_phone" value="' . $value . '" class="regular-text" placeholder="+380*********">';
    echo '<p class="description">Формат: +380*********</p>';
}

function fi_email_field() {
    $value = esc_attr(get_option('fi_email', ''));
    echo '<input type="email" name="fi_email" value="' . $value . '" class="regular-text">';
}

function fi_address_field() {
    $value = esc_attr(get_option('fi_address', ''));
    echo '<input type="text" name="fi_address" value="' . $value . '" class="regular-text">';
}

function fi_hours_field() {
    $value = esc_attr(get_option('fi_hours', ''));
    echo '<input type="text" name="fi_hours" value="' . $value . '" class="regular-text">';
}

function fi_checkbox_field($args) {
    $name = $args['name'];
    $checked = checked(1, get_option($name, 0), false);
    echo '<input type="checkbox" name="' . esc_attr($name) . '" value="1" ' . $checked . '>';
}

// Print in footer
add_action('wp_footer', 'fi_print_footer_info');
function fi_print_footer_info() {
    echo '<div class="fi-footer-block">';

    if (get_option('fi_show_phone') && $phone = get_option('fi_phone')) {
        echo '<div class="fi-footer-phone">Телефон: ' . esc_html($phone) . '</div>';
    }

    if (get_option('fi_show_email') && $email = get_option('fi_email')) {
        echo '<div class="fi-footer-email">Email: ' . esc_html($email) . '</div>';
    }

    if (get_option('fi_show_address') && $address = get_option('fi_address')) {
        echo '<div class="fi-footer-address">Адреса: ' . esc_html($address) . '</div>';
    }

    if (get_option('fi_show_hours') && $hours = get_option('fi_hours')) {
        echo '<div class="fi-footer-hours">Години роботи: ' . esc_html($hours) . '</div>';
    }

    echo '</div>';
}

// Styles
add_action('wp_enqueue_scripts', 'fi_enqueue_styles');
function fi_enqueue_styles() {
    wp_enqueue_style(
        'fi-footer-style',
        plugin_dir_url(__FILE__) . 'styles/styles.css',
        array(),
        '1.0'
    );
}

// Scripts
add_action('admin_enqueue_scripts', 'fi_enqueue_scripts');
function fi_enqueue_scripts() {
    wp_enqueue_script(
        'fi-script',
        plugin_dir_url(__FILE__) . 'js/validator.js',
        array('jquery'),
        '1.1',
        true
    );
}