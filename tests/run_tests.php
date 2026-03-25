<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/RandomGenerator.php';

// ── Tiny assertion helpers ───────────────────────────────────────────────────

$passed = 0;
$failed = 0;

function assert_true(bool $condition, string $label): void
{
    global $passed, $failed;
    if ($condition) {
        echo "\033[32m  ✓ {$label}\033[0m\n";
        $passed++;
    } else {
        echo "\033[31m  ✗ {$label}\033[0m\n";
        $failed++;
    }
}

function assert_equals(mixed $expected, mixed $actual, string $label): void
{
    assert_true($expected === $actual, "{$label} (expected: " . var_export($expected, true) . ", got: " . var_export($actual, true) . ")");
}

function assert_throws(callable $fn, string $exceptionClass, string $label): void
{
    global $passed, $failed;
    try {
        $fn();
        echo "\033[31m  ✗ {$label} — no exception thrown\033[0m\n";
        $failed++;
    } catch (\Throwable $e) {
        if ($e instanceof $exceptionClass) {
            echo "\033[32m  ✓ {$label}\033[0m\n";
            $passed++;
        } else {
            echo "\033[31m  ✗ {$label} — wrong exception: " . get_class($e) . "\033[0m\n";
            $failed++;
        }
    }
}

// ── Tests ────────────────────────────────────────────────────────────────────

$gen = new RandomGenerator();

echo "\n\033[1m── RandomGenerator::generate ──\033[0m\n";

$numbers = $gen->generate(1, 10, 5);
assert_equals(5, count($numbers), 'Genera exactamente 5 números');

$numbers = $gen->generate(1, 10, 1);
assert_true($numbers[0] >= 1 && $numbers[0] <= 10, 'Valor único dentro del rango [1,10]');

$numbers = $gen->generate(7, 7, 3);
assert_equals([7, 7, 7], $numbers, 'Rango min=max genera solo ese valor');

$numbers = $gen->generate(-50, 50, 20);
$allInRange = true;
foreach ($numbers as $n) {
    if ($n < -50 || $n > 50) { $allInRange = false; break; }
}
assert_true($allInRange, 'Todos los valores en rango negativo [-50, 50]');

$numbers = $gen->generate(0, 1000, 100);
assert_equals(100, count($numbers), 'Genera 100 números (cantidad máxima)');

echo "\n\033[1m── RandomGenerator::validate — casos válidos ──\033[0m\n";

assert_true((function() use ($gen) {
    try { $gen->validate(0, 100, 10); return true; }
    catch (\Exception $e) { return false; }
})(), 'Sin excepción con parámetros válidos');

echo "\n\033[1m── RandomGenerator::validate — casos inválidos ──\033[0m\n";

assert_throws(
    fn() => $gen->validate(100, 0, 10),
    InvalidArgumentException::class,
    'Lanza excepción cuando min > max'
);

assert_throws(
    fn() => $gen->validate(1, 10, 0),
    InvalidArgumentException::class,
    'Lanza excepción cuando cantidad < 1'
);

assert_throws(
    fn() => $gen->validate(1, 10, 101),
    InvalidArgumentException::class,
    'Lanza excepción cuando cantidad > 100'
);

echo "\n\033[1m── RandomGenerator::stats ──\033[0m\n";

$stats = $gen->stats([3, 1, 4, 1, 5, 9, 2, 6]);
assert_equals(1,    $stats['min'], 'stats: min correcto');
assert_equals(9,    $stats['max'], 'stats: max correcto');
assert_equals(31,   $stats['sum'], 'stats: sum correcto');
assert_equals(3.88, $stats['avg'], 'stats: avg correcto (2 decimales)');

$stats = $gen->stats([42]);
assert_equals(42, $stats['min'], 'stats: un solo elemento — min');
assert_equals(42, $stats['max'], 'stats: un solo elemento — max');

$stats = $gen->stats([]);
assert_true($stats['min'] === null, 'stats: array vacío devuelve null');

// ── Summary ──────────────────────────────────────────────────────────────────

echo "\n\033[1m────────────────────────────────\033[0m\n";
echo "\033[32m  Passed: {$passed}\033[0m  ";
echo "\033[31mFailed: {$failed}\033[0m\n\n";

exit($failed > 0 ? 1 : 0);
