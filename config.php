<?php
// Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS) . DS;
define ('SITE_PATH', $sitePath); // путь к корневой папке сайта


return array(
    // для подключения к бд
    "DB_USER" => 'root',
    "DB_PASS" => '123',
    "DB_HOST" => 'localhost',
    "DB_NAME" => 'db_bj',
);