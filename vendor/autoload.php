<?php

// autoload.php @generated by Composer

require_once __DIR__ . '/composer/autoload_real.php';

return ComposerAutoloaderInit5e3f6c923c4693ceb713e9eb538fe255::getLoader();


set_error_handler(function ($error_level, $error_message, $error_file, $error_line)
{
    $error = "lvl: " . $error_level . " | msg:" . $error_message . " | file:" . $error_file . " | ln:" . $error_line;
    $log = new \logger\logger();
    $log::log($error, $error_level);
});