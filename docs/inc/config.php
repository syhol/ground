<?php

function getPageUrl()
{
    $pageURL = 'http';

    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }

    $pageURL .= "://" . $_SERVER["SERVER_NAME"];

    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["REQUEST_URI"];
    }

    return $pageURL;
}
