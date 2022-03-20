<?php

use Config\Config;
dd(1);
if (isset($_SESSION['_admin_log_'])) {
    unset($_SESSION['_admin_log_']);
    redirect('login.php?secret=' . md5(Config::SECRET_LOGIN));
}
