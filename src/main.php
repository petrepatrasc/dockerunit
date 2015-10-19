#!/usr/bin/env php

<?php
namespace DockerUnit\Setup;

use DockerUnit\Core\DependencyInjection\ContainerSingleton;

require_once 'vendor/autoload.php';

$container = ContainerSingleton::getInstance();

$cliArguments = $container->get('dockerunit.phar.cli_arguments.builder')
    ->withPharFile('sample')
    ->build();

var_dump($cliArguments);
