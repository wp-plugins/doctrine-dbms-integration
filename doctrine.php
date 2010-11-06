<?php
/*
Plugin Name: Doctrine DBMS Integration
Plugin URI: 
Description: Doctrine DBMS Integration
Author: Fulvio Cazzanti
Version: 1.0.0
Author URI: ilsant0.wordpress.com 
*/

// test.php

$lib = dirname(__FILE__) . '/doctrine2-orm/lib/';
require $lib . 'vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', $lib . 'vendor/doctrine-common/lib');
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', $lib . 'vendor/doctrine-dbal/lib');
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', $lib);
$classLoader->register();

// Git Setup
$classloader = new \Doctrine\Common\ClassLoader('Symfony', $lib . 'vendor/');
$classloader->register();


use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;

// ...

if ($applicationMode == "development") {
    $cache = new \Doctrine\Common\Cache\ArrayCache;
} else {
    $cache = new \Doctrine\Common\Cache\ArrayCache; //ApcCache;
}

$config = new Configuration;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(__DIR__ . '/Entities');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('appName\Proxies');

if ($applicationMode == "development") {
    $config->setAutoGenerateProxyClasses(true);
} else {
    $config->setAutoGenerateProxyClasses(false);
}
/*
 /$connectionOptions = array(
	    'driver' => 'pdo_sqlite',
	    'path' => 'database.sqlite'
	);
 

$connectionParams = array(
    'dbname' => DB_NAME,
    'user' => DB_USER,
    'password' => DB_PASSWORD,
    'host' => DB_HOST,
    'driver' => 'pdo_mysql',
	);
*/
$connectionParams = array(
    'dbname' => 'gt',
    'user' => DB_USER,
    'password' => DB_PASSWORD,
    'host' => DB_HOST,
    'driver' => 'pdo_mysql',
	);

$em = EntityManager::create($connectionParams, $config);




$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
//$tool->createSchema($classes);

?>