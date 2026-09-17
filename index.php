<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

  <!-- Contenido principal -->
  <main class="flex-shrink-0">
    <div class="container">
      <h1 class="mt-5">Base de Datos Documental - Artículos</h1>
      <p class="lead">Registro de artículos de revista con su información bibliográfica.</p>

      <table class="table table-striped table-hover mt-4">
        <thead>
          <tr>
            <th>Autor</th>
            <th>Título</th>
            <th>Revista</th>
            <th>Año</th>
            <th>Volumen</th>
            <th>Paginas</th>
            <th>Idioma</th>
            <th>Clasificacion</th>
            <th>Palabras Clave</th>
            <th>Resumen</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require 'config/db.php';

          $stmt = $pdo->query("SELECT * FROM documentos");
          while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($fila['autor']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['revista']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['anio']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['volumen']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['paginas']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['idioma']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['clasificacion']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['palabras_clave']) . "</td>";
              echo "<td>" . htmlspecialchars($fila['resumen']) . "</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
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
