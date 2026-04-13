<?php
/**
 * Copyright 2026 Tom Coombs
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 */
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
