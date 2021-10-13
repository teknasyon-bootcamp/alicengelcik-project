<?php
namespace App;
require "../vendor/autoload.php";

Database::getInstance()->initialize("mariadb","root","root","project");

$routes=require "../app/routes.php";

(new Router($routes))();