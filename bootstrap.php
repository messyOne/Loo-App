<?php

use Loo\Core\MasterFactory;
use Loo\Data\Settings;

define('ROOT', dirname(__DIR__));

include_once 'vendor/autoload.php';

$factory = new MasterFactory();
Settings::setConfig($factory->getDataFactory()->getConfig());
Settings::setErrorHandling();
Settings::setPhpSettings();
