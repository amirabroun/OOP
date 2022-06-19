<?php

if (empty($_SESSION)) {
    session_start();
}

if ((uri() != "/") and preg_match('{/$}', uri())) {
    redirect()->route(preg_replace('{/$}', '', uri()));
}

if (empty($_SESSION["_admin_log_"]) && !(in_array(uri(), ignoreAuthPage()))) {
    fail();
}

if (isset($_SESSION["_admin_log_"]) && uri() === ('login/secret/' . md5(secretKey('secret_login')))) {
    redirect()->route('/');
}
