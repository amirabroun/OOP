<?php require __DIR__ . "/../vendor/autoload.php";

use Config\Config;

if (empty($_SESSION)) {
    session_start();
}

if (empty($_SESSION["_admin_log_"])) {
    if (!in_array(pageName(), Config::IGNORE_AUTH_PAGE))
        fail();

    if (pageName() === 'login') {
        if (!GET('secret') || !(GET('secret') === md5(Config::SECRET_LOGIN)))
            fail();
    }
} else
    redirect('/');