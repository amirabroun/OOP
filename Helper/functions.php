<?php

namespace Helper;

use Helper\Functions\Validator;
use Helper\Functions\Request;
use Config\Config;
use Throwable;

class Helper extends Config
{
    public static function sluggable($data)
    {
        return str_replace(' ', '-', $data);
    }

    public static function sanitise($data)
    {
        return trim(strip_tags($data));
    }

    public static function sanitiseNumber($data)
    {
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function url($path = '')
    {
        return Request::originBaseUrl() . '/' . ltrim($path, '/');
    }

    public static function assets($path = '')
    {
        return Request::originBaseUrl() . '/Assets/' . ltrim($path, '/');
    }

    public static function setTitle()
    {
        $page = str_replace(['/', '.php'], '', $_SERVER['SCRIPT_NAME']);
        switch ($page) {
            case 'product':
                return parent::APP_TITLE . 'لیست محصولات | ';
            default:
                return parent::APP_TITLE;
        }
    }

    public static function categoryLink($id): string
    {
        return "/product.php?category=$id";
    }

    public function productLink($slug)
    {
        return $this->url("/single-product.php?product=$slug");
    }

    public static function dd(...$data)
    {
        die(var_dump($data));
    }

    public static function bcrypt($password, $hash = null)
    {
        if (!is_null($hash)) {
            return password_verify($password, $hash);
        }
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function responseJson($data)
    {
        die(json_encode($data));
    }

    public static function redirect($path)
    {
        header("location: $path");
        exit();
    }

    public static function recaptchaVerify($secret_key, $token): bool
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['secret' => $secret_key, 'response' => $token]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $captcha_validation = json_decode($response, true);
        return $captcha_validation["success"] === true;
    }

    public static function generateDigit(int $length)
    {
        try {
            if ($length >= 1) {
                $start = str_repeat("0", $length - 1);
                $end = str_repeat("9", $length - 1);
                return random_int("1$start", "9$end");
            }
            return false;
        } catch (Throwable $exception) {
            return false;
        }
    }

    public static function sortingArray(array $input_array, string $sort_key, string $sort_type): array
    {
        $column_sort = array_column($input_array, $sort_key);
        if (!$column_sort) {
            return $input_array;
        }
        $sort = ($sort_type === 'ASC') ? SORT_ASC : SORT_DESC;
        array_multisort($column_sort, $sort, $input_array);
        return $input_array;
    }

    public static function price($price, $text = true): string
    {
        return number_format($price) . ($text === true ? ' تومان' : null);
    }

    public static function validateProductCode(string $data)
    {
        if (trim($data) === "" || empty(trim($data))) {
            return false;
        }
        if (!preg_match("/^([A-Z]{3}+)-(\d{8})$/", $data)) {
            return false;
        }
        return $data;
    }

    public static function isAjaxRequest(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
// die();

// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
//     $path = '../';
// }

// require_once @$path . 'functions/requests.php';

// require_once @$path . 'functions/others.php';
// require_once @$path . 'functions/validations.php';
