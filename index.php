<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="favicon.ico">
  <title>Sistema de registro de datos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Sistema de gestión de registro de datos</h1>

  <form action="guardar_registro.php" method="POST">
    <label for="rut">Rut:</label>
    <input type="text" id="rut" name="rut" required>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required>

    <?php
      // Conexión a la base de datos
      $conexion = mysqli_connect("localhost", "root", "", "registro");

      // Consulta para obtener los cargos desde la base de datos
      $consulta_cargos = "SELECT * FROM cargos";
      $resultados_cargos = mysqli_query($conexion, $consulta_cargos);
    ?>

    <label for="cargo">Cargo:</label>
    <select id="cargo" name="cargo" required>
      <?php while ($fila_cargo = mysqli_fetch_assoc($resultados_cargos)) { ?>
        <option value="<?php echo $fila_cargo['id']; ?>"><?php echo $fila_cargo['nombre']; ?></option>
      <?php } ?>
    </select>

    <button type="submit">Registrar</button>
  </form>

  <h2>Listado de registros:</h2>

  <form action="buscar_registros.php" method="POST">
    <label for="opcion">Buscar por:</label>
    <select id="opcion" name="opcion">
      <option value="rut">Rut</option> <!-- Nueva opción para buscar por Rut -->
      <option value="nombre">Nombre</option>
      <option value="telefono">Teléfono</option>
      <option value="cargo">Cargo</option>
    </select>

    <input type="text" id="valor_busqueda" name="valor_busqueda" placeholder="Valor de búsqueda" required>
    <button type="submit">Buscar</button>
  </form>

  <table>
    <tr>
      <th>Rut</th>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Cargo</th>
      <th>Acciones</th>
    </tr>

    <?php
      // Consulta para obtener todos los registros desde la base de datos
      $consulta_registros = "SELECT * FROM registros";
      $resultados_registros = mysqli_query($conexion, $consulta_registros);

      while ($fila_registro = mysqli_fetch_assoc($resultados_registros)) {
        echo "<tr>";
        echo "<td>" . $fila_registro['rut'] . "</td>";
        echo "<td>" . $fila_registro['nombre'] . "</td>";
        echo "<td>" . $fila_registro['telefono'] . "</td>";

        // Consulta para obtener el nombre del cargo desde la tabla "cargos"
        $consulta_cargo = "SELECT nombre FROM cargos WHERE id = " . $fila_registro['cargo'];
        $resultado_cargo = mysqli_query($conexion, $consulta_cargo);
        $fila_cargo = mysqli_fetch_assoc($resultado_cargo);
        echo "<td>" . $fila_cargo['nombre'] . "</td>";

        echo "<td>";
        echo "<a href='editar_registro.php?id=" . $fila_registro['id'] . "'>Editar</a> | ";
        echo "<a href='eliminar_registro.php?id=" . $fila_registro['id'] . "'>Eliminar</a>";
        echo "</td>";

        echo "</tr>";
      }
    ?>
  </table>

  <form action="eliminar_todos_registros.php" method="POST">
    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar todos los registros?')">Eliminar todos los registros</button>
  </form>

  <?php
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
  ?>
</body>
</html>
