<?php

use Doctrine\ORM\EntityManager; // Import EntityManager
use Doctrine\ORM\Tools\Setup; // Import Setup

// Doctrine configuration
$isDevMode = true; // Set to true if you want to see SQL logs
$proxyDir = null; // Set to null if you don't want to use proxy
$cache = null; // Set to null if you don't want to use cache
$useSimpleAnnotationReader = false; // Set to false if you don't want to use annotations

// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(
    // An array of paths to entities classes
    [__DIR__ . "/../src/Entity"],
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

$connectionParams = include 'database.php'; // Get database configuration

$entityManager = EntityManager::create($connectionParams, $config); // Create EntityManager

// Test Connection
// $sql = "SELECT * FROM users";
// $stmt = $conn->query($sql);

// $rows = $stmt->fetchAllAssociative();

// print_r($rows);
