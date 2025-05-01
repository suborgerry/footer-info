<?php

function fi_validate_phone($input) {
    return preg_match('/^\+380\d{9}$/', $input) ? $input : '';
}
