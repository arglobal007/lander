<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/system/bootstrap.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/tracking/helpers.php';

// Fetch live landing pages from DB
$landingPages = [];
$totalPages = 0;

try {
    $pdo = baby_katha_db();
    $stmt = $pdo->query("SELECT filename, title, tracking_plan, created_at FROM landing_pages ORDER BY created_at DESC LIMIT 10");
    $landingPages = $stmt ? ($stmt->fetchAll() ?: []) : [];
    $totalPages = (int)$pdo->query("SELECT COUNT(*) FROM landing_pages")->fetchColumn();
} catch (\Throwable $e) {
    $landingPages = [];
    $totalPages = 0;
}
