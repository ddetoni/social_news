<?php
function resolve_view($page)
{
	switch ($page) {
		case 'home':
			return __DIR__ . '/../content.php';
		case 'last_news':
			return __DIR__ . '/../last_news.php';
		case 'panel':
			return __DIR__ . '/../panel.php';
		case 'register':
			return __DIR__ . '/../register_content.html';
		case 'add_news':
			return __DIR__ . '/../add_news_content.html';
		case 'my_news':
			return __DIR__ . '/../my_news.php';
		case 'favorite_news':
			return __DIR__ . '/../favorite_news.php';
		case 'add_server':
			return __DIR__ . '/../add_server_content.php';
		case 'import_news':
			return __DIR__ . '/../import_news.php';
		case 'alterate_permition':
			return __DIR__ . '/../alterate_permition.php';
		case 'edit_news':
			return __DIR__ . '/../edit_news.php';
		case 'news':
			return __DIR__ . '/../news_view.php';
		default:
			return __DIR__ . '/../content.php';
	}
}
