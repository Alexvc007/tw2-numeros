<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generador de Números Aleatorios</title>
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

    header {
      text-align: center;
      margin-bottom: 32px;
    }

    .header__eyebrow {
      font-size: 16px;
      color: #777;
    }

    .header__title {
      font-size: 48px;
      font-weight: bold;
      color: #2c3e50;
    }

    .header__title span {
      color: #e74c3c;
    }

    /* Estilo para el main container */
    main {
      width: 100%;
      max-width: 600px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card {
      background-color: #ecf0f1;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card__section {
      margin-top: 20px;
    }

    /* Estilo para los campos */
    .fields-row {
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .field {
      flex: 1;
    }

    .field__label {
      font-size: 14px;
      margin-bottom: 6px;
      color: #555;
    }

    .field__input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
      background-color: #f9f9f9;
      color: #333;
      transition: border-color 0.3s ease;
    }

    .field__input:focus {
      border-color: #3498db;
      outline: none;
    }

    .field__hint {
      font-size: 12px;
      color: #7f8c8d;
      margin-top: 8px;
    }

    /* Estilo para los botones */
    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn--primary {
      background-color: #3498db;
      color: white;
    }

    .btn--primary:hover {
      background-color: #2980b9;
    }

    .btn--ghost {
      background-color: transparent;
      color: #3498db;
      border: 2px solid #3498db;
    }

    .btn--ghost:hover {
      background-color: #3498db;
      color: white;
    }

    .alert {
      padding: 12px;
      background-color: #f39c12;
      color: white;
      border-radius: 4px;
      margin-bottom: 16px;
      font-size: 14px;
    }
  </style>
</head>
<body>

<header class="header">
  <p class="header__eyebrow">Utilidad &mdash; v1.0</p>
  <h1 class="header__title">RANDOM<br><span>GEN</span></h1>
</header>

<main>
  <div class="card">
    <div class="card__section">

      <?php if (!empty($error)): ?>
        <div class="alert" style="margin-bottom:24px;">
          ⚠ <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">

        <div class="fields-row">
          <div class="field">
            <label class="field__label" for="min">Mínimo</label>
            <input
              class="field__input"
              type="number"
              id="min"
              name="min"
              value="<?= htmlspecialchars($form['min']) ?>"
              placeholder="0"
              required
            >
          </div>

          <div class="field">
            <label class="field__label" for="max">Máximo</label>
            <input
              class="field__input"
              type="number"
              id="max"
              name="max"
              value="<?= htmlspecialchars($form['max']) ?>"
              placeholder="100"
              required
            >
          </div>
        </div>

        <div class="field" style="margin-top:20px;">
          <label class="field__label" for="quantity">Cantidad de números</label>
          <input
            class="field__input field__input--sm"
            type="number"
            id="quantity"
            name="quantity"
            value="<?= htmlspecialchars($form['quantity']) ?>"
            min="1"
            max="100"
            placeholder="10"
            required
          >
          <p class="field__hint">Entre 1 y 100 números</p>
        </div>

        <div class="actions" style="margin-top:28px;">
          <button class="btn btn--primary" type="submit">Generar</button>
          <button class="btn btn--ghost" type="reset">Limpiar</button>
        </div>

      </form>
    </div>
  </div>
</main>

</body>
</html>