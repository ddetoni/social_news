<?php
require_once __DIR__ . '/app/bootstrap.php';
require_once __DIR__ . '/app/router.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$partial = isset($_GET['partial']) ? (int)$_GET['partial'] : 0;
$view = resolve_view($page);

if ($partial === 1) {
	include $view;
	exit;
}

include __DIR__ . '/app/views/layout.php';
