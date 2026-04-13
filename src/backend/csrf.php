<?php
function init_session()
{
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => env('SESSION_DOMAIN', ''),
        'secure' => env('SESSION_SECURE', 'false') === 'true',
        'httponly' => true,
        'samesite' => 'None'
    ]);

    session_start();
}

function generate_csrf()
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf'] = [
        'token' => $token,
        'time' => time()
    ];
    return $token;
}

function validate_csrf()
{
    $headers = getallheaders();
    $given = $headers['X-CSRF-Token'] ?? '';
    $stored = $_SESSION['csrf']['token'] ?? '';

    if (!hash_equals($stored, $given)) {
        send_response(["message" => "Invalid CSRF"], 403);
    }

    if ($_SESSION['csrf']['time'] + 86400 < time()) {
        send_response(["message" => "CSRF expired"], 403);
    }
}
