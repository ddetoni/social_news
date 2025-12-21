<?php
require_once __DIR__ . '/../dbconnect.php';

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
