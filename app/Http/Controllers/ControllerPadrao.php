<?php

namespace App\Http\Controllers;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ControllerPadrao extends Controller {

    protected $entityManager;

    function getEntityManager() {
        if (!isset($this->entityManager)) {
            $this->entityManager = $this->getInstanceEntityManager();
        }
        return $this->entityManager;
    }

    private function getInstanceEntityManager() {
        $paths = array("App/Models");
        $isDevMode = false;
        // the connection configuration
        $dbParams = array(
            'driver'    => 'pdo_pgsql',
            'user'      => 'postgres',
            'password'  => '2358',
            'dbname'    => 'magaApp',
            'host'      => 'localhost'
        );
        
        $this->config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        return EntityManager::create($dbParams, $this->config);
    }

}
