<?php

namespace Config;

class Config
{
    public const ADMIN_DOMAIN = 'admin.didishop.test';
    public const PUBLIC_DOMAIN = 'public.didishop.test';
    public const ORIGIN_DOMAIN = 'didishop.test';

    public const ADMIN_DOMAIN_ROOT = '';
    public const PUBLIC_DOMAIN_ROOT = '';
    public const ORIGIN_DOMAIN_ROOT = '';

    public const SECRET_LOGIN = '123456';
    public const SECRET_KEY = '6Lcq2-QeAAAAAItXYWqIfYEOyz_EyIxLBQePclOi';
    public const SITE_KEY = '6Lcq2-QeAAAAANaigtjLYlAAVzSPiiJbjjQtbLi1';
    public const APP_TITLE = 'dd Shop';

    public const IGNORE_AUTH_PAGE = [
        'test',
        'login',
        'Resource/login',
        'requests/login',
        'requests/order',
        'Route/web',
        'Route/auth',
        'login/secret/e10adc3949ba59abbe56e057f20f883e'
    ];
}
