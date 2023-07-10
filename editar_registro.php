<?php
  // Verificar si se proporciona un ID válido en la URL
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "registro");

    // Obtener el ID del registro a editar
    $id = $_GET['id'];

    // Consulta para obtener los datos del registro a editar
    $consulta_editar = "SELECT * FROM registros WHERE id = $id";
    $resultado_editar = mysqli_query($conexion, $consulta_editar);

    // Verificar si se encontró el registro a editar
    if ($fila_editar = mysqli_fetch_assoc($resultado_editar)) {
      // Mostrar el formulario de edición con los datos del registro
      ?>
      <!DOCTYPE html>
      <html lang="es">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico">
        <title>Editar Registro</title>
        <link rel="stylesheet" href="style.css">
      </head>
      <body>
        <h1>Editar Registro</h1>

        <form action="guardar_edicion.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $fila_editar['id']; ?>">

          <label for="rut">Rut:</label>
          <input type="text" id="rut" name="rut" value="<?php echo $fila_editar['rut']; ?>" required>

          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" value="<?php echo $fila_editar['nombre']; ?>" required>

          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" value="<?php echo $fila_editar['telefono']; ?>" required>

          <?php
            // Consulta para obtener los cargos desde la base de datos
            $consulta_cargos = "SELECT * FROM cargos";
            $resultados_cargos = mysqli_query($conexion, $consulta_cargos);
          ?>

          <label for="cargo">Cargo:</label>
          <select id="cargo" name="cargo" required>
            <?php
              while ($fila_cargo = mysqli_fetch_assoc($resultados_cargos)) {
                $selected = ($fila_cargo['id'] == $fila_editar['cargo']) ? 'selected' : '';
                echo "<option value='" . $fila_cargo['id'] . "' " . $selected . ">" . $fila_cargo['nombre'] . "</option>";
              }
            ?>
          </select>

          <button type="submit">Guardar cambios</button>
        </form>
      </body>
      </html>
      <?php
    } else {
      echo "No se encontró el registro a editar.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
  } else {
    echo "ID de registro no válido.";
  }
?>
