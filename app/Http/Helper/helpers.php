<?php

function notLocal(): bool
{
    return (bool) config('app.env') !== "local";
}

function hasAuthyConfig(): bool
{
    return (bool) config('authy.app_id') && config('authy.app_secret');
}