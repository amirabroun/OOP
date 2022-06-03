<?php

/*
use App\Requests\LoginRequest;

function d($data)
{
    if (is_null($data)) {
        $str = "<i>NULL</i>";
    } else if ($data == "") {
        $str = "<i>Empty</i>";
    } else if (is_array($data)) {
        $str = "<table> ";
        foreach ($data as $value) {
            $str .= "<tr><td>" . gettype($value) . " -> </td><td>" . d($value) . " </td> </tr>";
        }
        $str .= "</table> <br>";
    } else if (is_object($data)) {
        $str = d(get_object_vars($data));
    } else if (is_bool($data)) {
        $str = "<i>" . ($data ? "True" : "False") . "</i>";
    } else {
        $str = $data;
        $str = preg_replace("/\n/", "\n", $str);
    }

    return $str;
}

function dd(...$data)
{
    die(d($data) . "<br>\n");
}

dd(null, new LoginRequest, 'amir', (object)'name', 12.012, true);

*/