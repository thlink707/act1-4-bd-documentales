<?php
require 'config/db.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autor          = trim(strip_tags($_POST['autor'] ?? ''));
    $titulo         = trim(strip_tags($_POST['titulo'] ?? ''));
    $revista        = trim(strip_tags($_POST['revista'] ?? ''));
    $anio_raw       = trim($_POST['anio'] ?? '');
    $volumen        = trim(strip_tags($_POST['volumen'] ?? ''));
    $paginas        = trim(strip_tags($_POST['paginas'] ?? ''));
    $idioma         = trim(strip_tags($_POST['idioma'] ?? ''));
    $clasificacion  = trim(strip_tags($_POST['clasificacion'] ?? ''));
    $palabras_clave = trim(strip_tags($_POST['palabras_clave'] ?? ''));
    $resumen        = trim(strip_tags($_POST['resumen'] ?? ''));

    if ($autor === '')  $errores[] = "El autor es obligatorio.";
    if ($titulo === '') $errores[] = "El título es obligatorio.";

    $anio = filter_var($anio_raw, FILTER_VALIDATE_INT);
    if ($anio_raw !== '' && ($anio === false || $anio < 1000 || $anio > date('Y'))) {
        $errores[] = "El año debe ser un valor entre 1000 y " . date('Y') . ".";
    }

    // Permite letras (con acentos), espacios, apóstrofes, puntos, guiones y &
    if (!preg_match('/^[\p{L}\s\.\'\-&]+$/u', $autor)) {
        $errores[] = "El autor no debe contener números ni símbolos raros.";
    }

    if (empty($errores)) {
        $stmt = $pdo->prepare("INSERT INTO documentos 
            (autor, titulo, revista, anio, volumen, paginas, idioma, clasificacion, palabras_clave, resumen) 
            VALUES 
            (:autor, :titulo, :revista, :anio, :volumen, :paginas, :idioma, :clasificacion, :palabras_clave, :resumen)");

        $stmt->execute([
            'autor' => $autor,
            'titulo' => $titulo,
            'revista' => $revista,
            'anio' => $anio ?: null,
            'volumen' => $volumen,
            'paginas' => $paginas,
            'idioma' => $idioma,
            'clasificacion' => $clasificacion,
            'palabras_clave' => $palabras_clave,
            'resumen' => $resumen
        ]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es" class="h-100" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Base de Datos Documental - Artículos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;user-select:none}
    body { padding-top: 60px; }
  </style>
</head>
<body class="d-flex flex-column h-100">

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">BD Documental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="agregar.php">Agregar documento</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Agregar nuevo documento</h1>

    <form method="POST" action="agregar.php" class="mt-4">
      <div class="mb-3">
        <label class="form-label">Autor</label>
        <input type="text" class="form-control" name="autor" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Revista</label>
        <input type="text" class="form-control" name="revista">
      </div>
      <div class="mb-3">
        <label class="form-label">Año</label>
        <input type="number" class="form-control" name="anio">
      </div>
      <div class="mb-3">
        <label class="form-label">Volumen</label>
        <input type="text" class="form-control" name="volumen">
      </div>
      <div class="mb-3">
         <label class="form-label">Páginas</label>
         <input type="text" class="form-control" name="paginas" placeholder="ej. 45-60">
      </div>
      <div class="mb-3">
        <label class="form-label">Idioma</label>
        <input type="text" class="form-control" name="idioma">
      </div>
      <div class="mb-3">
        <label class="form-label">Clasificación</label>
        <input type="text" class="form-control" name="clasificacion" placeholder="tema central del documento">
      </div>
      <div class="mb-3">
        <label class="form-label">Palabras clave</label>
        <input type="text" class="form-control" name="palabras_clave" placeholder="separadas por comas">
      </div>
      <div class="mb-3">
        <label class="form-label">Resumen</label>
        <textarea class="form-control" name="resumen" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
  </div>
</main>

  <footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
      <span class="text-body-secondary">Actividad 1.5 - Bases de Datos Documentales</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


