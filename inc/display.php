<?php

add_action('wp_footer', 'fi_print_footer_info');
function fi_print_footer_info() {
    echo '<div class="fi-footer-block">';

    if (get_option('fi_show_phone') && $phone = get_option('fi_phone')) {
        echo '<div class="fi-footer-phone">Phone number: ' . esc_html($phone) . '</div>';
    }

    if (get_option('fi_show_email') && $email = get_option('fi_email')) {
        echo '<div class="fi-footer-email">Email: ' . esc_html($email) . '</div>';
    }

    if (get_option('fi_show_address') && $address = get_option('fi_address')) {
        echo '<div class="fi-footer-address">Adress: ' . esc_html($address) . '</div>';
    }

    if (get_option('fi_show_hours') && $hours = get_option('fi_hours')) {
        echo '<div class="fi-footer-hours">Working hours: ' . esc_html($hours) . '</div>';
    }

    echo '</div>';
}
