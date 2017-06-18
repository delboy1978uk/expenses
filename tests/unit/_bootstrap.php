<?php

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Del\Expenses\ExpensesPackage;

// Here you can initialize variables that will be available to your tests
$package = new ExpensesPackage();

$config = require_once 'migrant-cfg.php';
$credentials = new DbCredentials($config['db']);

$containerSvc = ContainerService::getInstance();
$containerSvc->setDbCredentials($credentials);
$containerSvc->registerToContainer($package);

$container = $containerSvc->getContainer();