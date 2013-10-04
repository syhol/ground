<?php

if(class_exists('SplClassLoader') === false)
{
    include 'manual-autoload.php';
}

$classLoader = new SplClassLoader('Ground', __DIR__ . '/src');
$classLoader->register();