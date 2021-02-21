<?php
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('twentyseconds\\', __DIR__."/twentyseconds");
$loader->addPsr4('api\\', __DIR__."/api");

require_once(__DIR__."/helper.php");

ini_set('error_log', join('/', [__DIR__, '..', 'logs', 'app.log']));

dbg("app started");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

$dsn = $_SERVER["XSTORE_DB"];


$db = $db = \ParagonIE\EasyDB\Factory::fromArray(url_to_pdo_dsn($dsn));

return ['db'=>$db];