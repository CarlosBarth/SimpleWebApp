<?php

//require 'vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Migrations\Configuration\Migration\ConfigurationFileWithFallback;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;

//$paths = [__DIR__ . 'Entities'];
//$isDevMode = true;
//$configurationParameter = 'database/migrations/migrations.php';
//$config = new ConfigurationFileWithFallback($configurationParameter);
//$ORMconfig = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
//$entityManager = EntityManager::create(['driver' => 'pdo_pgsql', 'memory' => true], $ORMconfig);

// cli-config.php
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

//return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
