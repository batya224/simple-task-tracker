<?php

// DATABASE CREDINTALS
define('DB_HOST', 'localhost');
define('DB_NAME', 'task-tracker');
define('DB_USER', 'root');
define('DB_PASS', '');

// URL
define('APP_PATH', dirname(__FILE__, 2));
define('BASE_URL', BASE_URL());
define('SITE_NAME', 'Simple task tracker');


function BASE_URL()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'].'/testtask1';
}
