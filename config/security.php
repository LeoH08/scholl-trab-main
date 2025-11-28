<?php

declare(strict_types=1);

if (!isset($cspNonce)) {
    $cspNonce = base64_encode(random_bytes(16));
}

// Headers (enviar antes de qualquer saída)
if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    // CSP com nonce para permitir scripts inline específicos
    header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; script-src 'self' 'nonce-{$cspNonce}'; font-src 'self';");
    // HSTS somente se HTTPS
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    if ($isHttps) {
        header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
    }
}

if (session_status() === PHP_SESSION_NONE) {
    $secure = isset($isHttps) ? $isHttps : (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
        (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
    );
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

// Regenerar ID (mitigar fixation) a cada nova visita de página crítica
if (empty($_SESSION['__sr'])) {
    session_regenerate_id(true);
    $_SESSION['__sr'] = time();
}

// CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
function csrf_token(): string
{
    return $_SESSION['csrf_token'] ?? '';
}
function verify_csrf(?string $token): bool
{
    return hash_equals($_SESSION['csrf_token'] ?? '', $token ?? '');
}
function csp_nonce(): string
{
    global $cspNonce;
    return $cspNonce;
}
