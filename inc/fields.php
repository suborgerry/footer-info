<?php

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
