<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (! $connection) {
    die('Connection error' . mysqli_error($connection));
}

define('ABSPATH', str_replace('\\', '/', dirname(__DIR__)) . '/');

$tempPath1 = explode('/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])));
$tempPath2 = explode('/', substr(ABSPATH, 0, - 1));
$tempPath3 = explode('/', str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])));

for ($i = count($tempPath2); $i < count($tempPath1); $i ++)
    array_pop($tempPath3);

$urladdr = $_SERVER['HTTP_HOST'] . implode('/', $tempPath3);

if ($urladdr{strlen($urladdr) - 1} == '/') {
    define('HOMEURL', 'http://' . $urladdr);
    define('ADMINURL', 'http://' . $urladdr . 'admin/');
} else {
    define('HOMEURL', 'http://' . $urladdr . '/');
    define('ADMINURL', 'http://' . $urladdr . '/admin/');
}

unset($tempPath1, $tempPath2, $tempPath3, $urladdr);