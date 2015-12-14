#!/usr/bin/env php

<?php

include_once 'bootstrap.php';

use Loo\Task\DatabaseSetup;
use Symfony\Component\Console\Application;
use Task\Kickstart;

$application = new Application();
$application->add(new DatabaseSetup());
$application->add(new Kickstart());

$application->run();
