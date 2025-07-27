<?php
function isPro()
{
    if (class_exists('\App\Pro\Pro')) {
        return false;
    }
    return false;
}

function isProEnable()
{
    if (class_exists('\App\Pro\Pro')) {
        return false;
    }
    return false;
}

function proVersion()
{
    return config('pro.version');
}
