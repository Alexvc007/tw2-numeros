<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Números Aleatorios</title>

    <!-- Incluir Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Generador de Números Aleatorios</h1>

        <!-- Formulario -->
        <form action="/noo/index.php" method="POST" class="shadow p-4 rounded border">
            <div class="mb-3">
                <label for="count" class="form-label">¿Cuántos números aleatorios quieres generar?</label>
                <input type="number" class="form-control" name="count" required>
            </div>

            <div class="mb-3">
                <label for="min" class="form-label">Valor mínimo</label>
                <input type="number" class="form-control" name="min" required>
            </div>

            <div class="mb-3">
                <label for="max" class="form-label">Valor máximo</label>
                <input type="number" class="form-control" name="max" required>
            </div>

            <button type="submit" name="generate" class="btn btn-primary w-100">Generar</button>
        </form>

        <?php if (isset($numbers)): ?>
            <div class="mt-4">
                <h2>Resultados Generados</h2>
                <div class="card p-3 mt-3">
                    <p><strong>Números Generados:</strong> <?php echo implode(", ", $numbers); ?></p>
                    <p><strong>Suma:</strong> <?php echo $sum; ?></p>
                    <p><strong>Promedio:</strong> <?php echo $average; ?></p>
                    <p><strong>Valor mínimo:</strong> <?php echo $minValue; ?></p>
                    <p><strong>Valor máximo:</strong> <?php echo $maxValue; ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Incluir los scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>