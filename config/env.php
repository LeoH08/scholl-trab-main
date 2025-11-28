<?php

declare(strict_types=1);

if (!function_exists('app_env')) {
    function app_env(string $key, ?string $default = null): ?string
    {
        static $vars = null;
        if ($vars === null) {
            $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
            $vars = is_file($file) ? parse_ini_file($file, false, INI_SCANNER_TYPED) : [];
        }
        if (array_key_exists($key, $vars)) {
            return (string)$vars[$key];
        }
        $v = getenv($key);
        return $v === false ? $default : $v;
    }
}

if (!function_exists('app_env_bool')) {
    function app_env_bool(string $key, bool $default = false): bool
    {
        $val = app_env($key, $default ? '1' : '0');
        return in_array(strtolower((string)$val), ['1', 'true', 'on', 'yes'], true);
    }
}
