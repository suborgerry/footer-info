<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

delete_option('fi_phone');
delete_option('fi_email');
delete_option('fi_address');
delete_option('fi_hours');

delete_option('fi_show_phone');
delete_option('fi_show_email');
delete_option('fi_show_address');
delete_option('fi_show_hours');
