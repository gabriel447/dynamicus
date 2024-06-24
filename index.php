<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parcelas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

  <?php

  require_once "conexao.php";

  $sql = "SELECT * FROM parcelas";
  $conexao = novaConexao();
  $resultado = $conexao->query($sql);

  $registros = [];

  if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
      switch ($row['tipo']) {
        case 'VALOR MÍNIMO':
          $minimos[] = $row;
          break;
        case 'VALOR MÉDIO':
          $medios[] = $row;
          break;
        case 'VALOR MÁXIMO':
          $maximos[] = $row;
          break;
        case 'VALOR NORMAL':
          $normais[] = $row;
          break;
      }
    }

    $registros['minimos'] = $minimos;
    $registros['medios'] = $medios;
    $registros['maximos'] = $maximos;
    $registros['normais'] = $normais;
    
  } else {
    echo "Erro: " . $conexao->error;
  }

  $conexao->close();

  ?>

  <div class="accordion" id="accordionExample">
    <?php foreach ($registros as $tipo => $valores) : ?>
      <div class="accordion-item">
        <h2 class="accordion-header" id="<?= "heading{$tipo}" ?>">
          <button class="accordion-button <?= $tipo === 'minimos' ? 'show' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= strtolower($tipo); ?>" aria-expanded="<?= $tipo === 'minimos' ? 'true' : 'false'; ?>" aria-controls="collapse<?= strtolower($tipo); ?>">
            <?= ucfirst($tipo); ?> (<?= count($valores); ?>)
          </button>
        </h2>
        <div id="collapse<?= strtolower($tipo); ?>" class="accordion-collapse collapse <?= $tipo === 'minimos' ? 'show' : ''; ?>" aria-labelledby="<?= "heading{$tipo}"; ?>" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <?php foreach ($valores as $valor) : ?>
              <p><?= $valor['valor']; ?></p>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>