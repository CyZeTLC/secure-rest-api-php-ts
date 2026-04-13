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
function handle_request()
{
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($method === 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    // Routing
    if ($path === '/api/csrf' && $method === 'GET') {
        $token = generate_csrf();
        send_response(['csrf' => $token]);
    }

    if ($path === '/api/hello' && $method === 'GET') {
        send_response(['message' => 'Hello World']);
    }

    if ($path === '/api/data' && $method === 'POST') {
        validate_csrf();

        $input = json_decode(file_get_contents('php://input'), true);

        send_response([
            'received' => $input
        ]);
    }

    send_response(['message' => 'Not Found'], 404);
}
