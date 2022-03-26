<?php

function domain($key = null)
{
    $domain = [
        'admin' => getenv('ADMIN_DOMAIN'),
        'public' => getenv('PUBLIC_DOMAIN'),
        'origin' => getenv('ORIGIN_DOMAIN'),
    ];

    if ($key)
        return $domain[$key];

    return $domain;
}

function secretKey($key = null)
{
    $secret = [
        'secret_login' => getenv('SECRET_LOGIN'),
        'secret_recaptcha_key' => getenv('SECRET_KEY'),
        'site_recaptcha_key' => getenv('SITE_KEY'),
    ];

    if ($key)
        return $secret[$key];

    return $secret;
}

function appTitle()
{
    return getenv('APP_TITLE');
}

function ignoreAuthPage()
{
    return [
        'test',
        'login',
        'Resource/login',
        'requests/login',
        'requests/order',
        'Route/web',
        'Route/auth',
        'login/secret/e10adc3949ba59abbe56e057f20f883e',
        getenv('IGNORE_FILE_AUTH'),
    ];
}
