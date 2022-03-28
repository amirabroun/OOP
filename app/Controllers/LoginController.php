<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Requests\LoginRequest;
use App\Controllers\Controller;

class LoginController extends Controller
{
    public function adminLogin(LoginRequest $request)
    {
        $admin = $request->validate();

        if (!$this->recaptchaVerify($admin->grecaptcha))
            $this->failRecaptchaVerify();

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

    public function failRecaptchaVerify()
    {
        sweetAlert('لطفا ثابت کنید که ربات نیستید!', 'ورود ناموفق', 'error');
    }
}
