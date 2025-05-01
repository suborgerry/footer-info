<?php

add_action('admin_menu', function () {
    add_options_page(
        'Information in footer',
        'Information in footer',
        'manage_options',
        'footer-info',
        'fi_settings_page_form'
    );
});

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
        'Contact information settings',
        null,
        'fi-settings'
    );

    add_settings_field('fi_phone', 'Номер телефону', 'fi_phone_field', 'fi-settings', 'fi_main_section');
    add_settings_field('fi_email', 'Email', 'fi_email_field', 'fi-settings', 'fi_main_section');
    add_settings_field('fi_address', 'Адреса', 'fi_address_field', 'fi-settings', 'fi_main_section');
    add_settings_field('fi_hours', 'Години роботи', 'fi_hours_field', 'fi-settings', 'fi_main_section');

    add_settings_field('fi_show_phone', 'Показувати номер телефону?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_phone']);
    add_settings_field('fi_show_email', 'Показувати Email?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_email']);
    add_settings_field('fi_show_address', 'Показувати адресу?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_address']);
    add_settings_field('fi_show_hours', 'Показувати години роботи?', 'fi_checkbox_field', 'fi-settings', 'fi_main_section', ['name' => 'fi_show_hours']);
});

function fi_settings_page_form()
{
    ?>
    <div class="wrap">
        <h1>Information in footer</h1>
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
