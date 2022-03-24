<?php

namespace Controllers;

use Config\Config;
use Models\Admin;
use Requests\LoginRequest;

class LoginController extends Controller
{
    public function adminLogin(LoginRequest $request)
    {
        $admin = $request->validate();

        if (!$this->recaptchaVerify($admin->grecaptcha))
            sweetAlert('لطفا ثابت کنید که ربات نیستید!', 'ورود ناموفق', 'error');

        if (!$admin = Admin::doLogin($admin->username, $admin->password))
            $this->failAdminLogin();

        $this->successAdminLogin($admin);
    }

    public function successAdminLogin(object $admin)
    {
        $_SESSION['_admin_log_'] = [
            'id' => $admin->id,
            'first_name' => $admin,
            'last_name' => $admin->last_name,
            'full_name' => "{$admin->first_name} {$admin->last_name}",
        ];

        $text = $_SESSION['_admin_log_']['full_name'] . ' عزیز';
        $title = 'شما با موفقیت وارد شدید!';

        sweetAlert($text, $title, 'success', true);
    }

    public function failAdminLogin()
    {
        sweetAlert('اطلاعات وارد شده نامعتبر است!', 'ورود ناموفق', 'error');
    }
}
