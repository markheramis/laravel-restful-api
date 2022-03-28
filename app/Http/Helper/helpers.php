<?php

function notLocal(): bool
{
    return (bool) config('app.env') !== "local";
}

function hasAuthyConfig(): bool
{
    return (bool) config('authy.app_id') && config('authy.app_secret');
}

function censorPhoneNumber($number): string
{
    return str_pad(substr($number, -3), strlen($number), '*', STR_PAD_LEFT);
}

function decryptJWTToken($token): array
{
    $tokenParts = explode(".", $token);  
    $tokenPayload = base64_decode($tokenParts[1]);
    return json_decode($tokenPayload, true);
}

function isJSON($string): bool
{
    return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

function filesize_formatted($path): string
{
    $size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}