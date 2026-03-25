<?php

declare(strict_types=1);

class Request
{
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function postInt(string $key, ?int $default = null): ?int
    {
        $value = $this->post($key);
        if ($value === null || $value === '') {
            return $default;
        }
        return filter_var($value, FILTER_VALIDATE_INT) !== false
            ? (int) $value
            : null;
    }
}
