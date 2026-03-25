<?php
/** @var array $results */
$numbers  = $results['numbers'];
$min      = $results['min'];
$max      = $results['max'];
$stats    = $results['stats'];
$range    = ($max - $min) ?: 1; // avoid division by zero
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generador de Números Aleatorios - Resultados</title>
  <style>
    /* Estilos generales */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f7fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
    }

    /* Estilo para la tarjeta principal */
    .card {
      width: 100%;
      max-width: 900px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    /* Barra de estadísticas */
    .stats-strip {
      display: flex;
      justify-content: space-between;
      margin-bottom: 24px;
    }

    .stat {
      text-align: center;
    }

    .stat__label {
      font-size: 14px;
      color: #555;
    }

    .stat__value {
      font-size: 18px;
      font-weight: bold;
      color: #2c3e50;
    }

    /* Estilo para el título de resultados */
    .results-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .results-header__title {
      font-size: 28px;
      font-weight: bold;
      color: #2c3e50;
    }

    .results-header__meta {
      font-size: 14px;
      color: #7f8c8d;
    }

    /* Estilo de la tabla */
    .table-wrap {
      margin-top: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th, table td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    .col-index {
      width: 10%;
    }

    .col-value {
      width: 30%;
      font-weight: bold;
    }

    .col-bar {
      width: 60%;
    }

    /* Estilo para la barra de distribución */
    .bar-track {
      width: 100%;
      background-color: #ecf0f1;
      border-radius: 4px;
      height: 8px;
      margin-top: 6px;
    }

    .bar-fill {
      height: 100%;
      background-color: #3498db;
      border-radius: 4px;
    }

    /* Estilo para el pie de página */
    .footer {
      text-align: center;
      font-size: 14px;
      color: #7f8c8d;
      margin-top: 40px;
    }

  </style>
</head>
<body>

  <div class="card">
    <!-- Stats strip -->
    <div class="stats-strip">
      <div class="stat">
        <p class="stat__label">Mínimo</p>
        <p class="stat__value"><?= htmlspecialchars((string)$stats['min']) ?></p>
      </div>
      <div class="stat">
        <p class="stat__label">Máximo</p>
        <p class="stat__value"><?= htmlspecialchars((string)$stats['max']) ?></p>
      </div>
      <div class="stat">
        <p class="stat__label">Promedio</p>
        <p class="stat__value"><?= htmlspecialchars((string)$stats['avg']) ?></p>
      </div>
      <div class="stat">
        <p class="stat__label">Suma</p>
        <p class="stat__value"><?= htmlspecialchars((string)$stats['sum']) ?></p>
      </div>
    </div>

    <!-- Table -->
    <div class="card__section">
      <div class="results-header">
        <h2 class="results-header__title">RESULTADOS</h2>
        <span class="results-header__meta">
          Rango [<?= $min ?>, <?= $max ?>] &nbsp;·&nbsp; <?= count($numbers) ?> números
        </span>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th class="col-index">#</th>
              <th>Valor</th>
              <th>Distribución</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($numbers as $i => $number): ?>
              <?php $pct = round((($number - $min) / $range) * 100); ?>
              <tr>
                <td class="col-index"><?= $i + 1 ?></td>
                <td class="col-value"><?= $number ?></td>
                <td class="col-bar">
                  <div class="bar-track">
                    <div class="bar-fill" style="width:<?= $pct ?>%"></div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <footer class="footer">RANDOM_GEN &mdash; PHP &middot; PRG Pattern</footer>

</body>
</html>