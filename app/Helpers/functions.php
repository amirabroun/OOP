<?php



require 'Functions/requests.php';
require 'Functions/validations.php';
require 'Functions/app.php';

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

function sluggable($data)
{
    return str_replace(' ', '-', $data);
}

function sanitise($data)
{
    return trim(strip_tags($data));
}

function sanitiseNumber($data)
{
    return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
}

function url($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
}

function assets($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/public/Assets/' . ltrim($path, '/');
}

function setTitle()
{
    $page = str_replace(['/', '.php'], '', $_SERVER['SCRIPT_NAME']);
    switch ($page) {
        case 'product':
            return appTitle() . 'لیست محصولات | ';
        default:
            return appTitle();
    }
}

function categoryLink($id): string
{
    return "/product.php?category=$id";
}

function productLink($slug)
{
    return url("/single-product.php?product=$slug");
}

function dd(...$data)
{
    die(var_dump([
        $data,
        'page name' => pageName(),
        'uri' => uri(),
    ]));
}

function ddd(...$data)
{
    die(json_encode([
        $data,
        'page name' => pageName(),
        'uri' => uri(),
        'url' => url(),
    ]));
}

function bcrypt($password, $hash = null)
{
    if (!is_null($hash)) {
        return password_verify($password, $hash);
    }

    return password_hash($password, PASSWORD_BCRYPT);
}

function responseJson($data)
{
    die(json_encode($data));
}

function redirect($path)
{
    header("location: $path");
    exit();
}

function recaptchaVerify($secret_key, $token): bool
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

function generateDigit(int $length)
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

function sortingArray(array $input_array, string $sort_key, string $sort_type): array
{
    $column_sort = array_column($input_array, $sort_key);
    if (!$column_sort) {
        return $input_array;
    }
    $sort = ($sort_type === 'ASC') ? SORT_ASC : SORT_DESC;
    array_multisort($column_sort, $sort, $input_array);
    return $input_array;
}

function price($price, $text = true): string
{
    return number_format($price) . ($text === true ? ' تومان' : null);
}

function isAjaxRequest(): bool
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * @param string $title
 * @param string $text
 * @param string $type
 * @param int $reload
 *
 * @return never
 */
function sweetAlert($text, $title = null, $type = 'success', $reload = false)
{
    responseJson([
        'data' => '',
        'status' => ($reload === false) ? 201 : 200,
        'message' => [
            'title' => $title,
            'text' => $text,
            'type' => $type
        ]
    ]);
}
/**
 * @param array $errors
 *
 * @return string $rules // this is string ready for sweet alert
 */
function sweetAlertValidatorErrorHandling(array $errors)
{
    $ruleAttributes = attributesTranslate('rule');
    $rules = '';

    foreach ($errors as $keyI => $i) {
        $cleanError = $errors[$keyI];

        foreach ($cleanError as $input => $error) {
            foreach ($ruleAttributes as $keyRuleAttributes => $rule) {

                if ($keyRuleAttributes == $error) {
                    $rules .= translate($input) . "\t" . ': ' . ' ' . $rule;
                }
            }
        }
    }

    return $rules;
}

// die();

// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
//     $path = '../';
// }

// require_once @$path . 'functions/requests.php';

// require_once @$path . 'functions/others.php';
// require_once @$path . 'functions/validations.php';
