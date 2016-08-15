<?php
// включим отображение всех ошибок
error_reporting (E_ALL); 

// подключаем конфиг
$config = include('config.php');

// подключаем ядро сайта
require_once(SITE_PATH . DS . 'core' . DS . 'autoloader.php');
Autoloader::init();
Application::setConfig($config);

// Загружаем router
$router = new Router();
// задаем путь до папки контроллеров.
$router->setPath (SITE_PATH . 'controllers');
// запускаем маршрутизатор
$router->start();
