<?php
use Doctrine\DBAL\DriverManager;

return DriverManager::getConnection([
    'dbname' => 'magaApp',
    'user' => 'postgres',
    'password' => '2358',
    'host' => 'localhost',
    'driver' => 'pdo_pgsql',
]);