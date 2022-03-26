<?php 

use App\Config\Config;

if (empty($_SESSION))
    session_start();

// if (empty($_SESSION["_admin_log_"])) {
//     if (!(in_array(pageName(), ignoreAuthPage()) || (in_array(uri(), ignoreAuthPage()))))
//         fail();
// }

if (uri() === ('login/secret/' . md5(secretKey('secret_login'))) && isset($_SESSION["_admin_log_"]))
    redirect('/');
