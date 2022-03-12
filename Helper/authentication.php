<?php
$request_page = ltrim(str_replace('.php', '', $_SERVER['SCRIPT_NAME']), '/');
$ignore_page = [
    'test',
    'login',
    'requests/login',
    'requests/order',
];

if (!isset($_SESSION['_admin_log_']) && !in_array($request_page, $ignore_page)) {
    http_response_code(404);
    exit();
}
