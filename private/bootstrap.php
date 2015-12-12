<?php

use Loo\Core\MasterFactory;
use Loo\Data\Settings;

require_once dirname(__DIR__).'/vendor/autoload.php';
require_once dirname(__DIR__).'/private/constants.php';

$factory = new MasterFactory();
Settings::setConfig($factory->getDataFactory()->getConfig());
Settings::setErrorHandling();
Settings::setPhpSettings();
