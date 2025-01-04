<?php

use app\src\Flash;
use app\src\Redirect;

function dd($data)
{
    print_r($data);
    die();
}

function json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

function path()
{
    $vendorDir = dirname(dirname(__FILE__));
    return dirname($vendorDir);
}

function flash($index, $message)
{
    Flash::add($index, $message);
}

function error($message)
{
    return "<label class='form-label text-danger'>{$message}</label>";
}

function success($message)
{
    return "<div class='alert alert-success mb-4'>{$message}</div>";
}

function redirect($target)
{
    Redirect::redirect($target);
    die();
}

function back()
{
    Redirect::back();
    die();
}

function search()
{
    return filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING);
}