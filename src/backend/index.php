<?php
require_once 'config.php';
load_env(__DIR__ . '/.env');

require_once 'cors.php';
require_once 'response.php';
require_once 'csrf.php';
require_once 'router.php';

$isDev = env('APP_ENV') === 'development';

if ($isDev) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}

handle_cors();
init_session();
handle_request();
