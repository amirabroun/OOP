<?php

if (empty($_SESSION)) {
    session_start();
}

if (($_SERVER['REQUEST_URI'] != "/") and preg_match('{/$}', $_SERVER['REQUEST_URI'])) {
    redirect()->route(preg_replace('{/$}', '', $_SERVER['REQUEST_URI']));
}

if (empty($_SESSION["_admin_log_"]) && !(in_array(uri(), ignoreAuthPage()))) {
    fail();
}

if (isset($_SESSION["_admin_log_"]) && uri() === ('login/secret/' . md5(secretKey('secret_login')))) {
    redirect()->route('/');
}
