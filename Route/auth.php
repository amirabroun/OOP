<?php require __DIR__ . "/../vendor/autoload.php";

use Config\Config;

if (empty($_SESSION)) {
    session_start();
}

if (empty($_SESSION["_admin_log_"])) {
    if (!in_array(pageName(), Config::IGNORE_AUTH_PAGE))
        fail();
} else if (pageName() === 'login') {
    if (!GET('secret') || GET('secret') !== md5(Config::SECRET_LOGIN))
        fail();
    redirect('/');
}

if (checkAction("log-out")) {
    if (isset($_SESSION['_admin_log_'])) {
        unset($_SESSION['_admin_log_']);

        redirect('login.php?secret=' . md5(Config::SECRET_LOGIN));
    }
}
