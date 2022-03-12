<?php

if (isset($_SESSION['_admin_log_'])) {

    unset($_SESSION['_admin_log_']);

    redirect('login.php?secret=' . md5(SECRET_LOGIN));
}
