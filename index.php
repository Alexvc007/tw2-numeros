<?php

require_once 'src/RandomNumberGenerator.php';
require_once 'src/RandomNumberStats.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
    $count = (int)$_POST['count'];
    $min = (int)$_POST['min'];
    $max = (int)$_POST['max'];

    // Crear una instancia del generador de números aleatorios
    $generator = new RandomNumberGenerator($count, $min, $max);
    $numbers = $generator->generateNumbers();

    // Crear una instancia de la clase de estadísticas
    $stats = new RandomNumberStats($numbers);

    // Obtener estadísticas
    $sum = $stats->sum();
    $average = $stats->average();
    $minValue = $stats->min();
    $maxValue = $stats->max();
}

// Incluir la vista
include 'views/index.php';

?>