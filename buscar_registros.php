<?php
// Verificar si se enviaron los datos del formulario
if (isset($_POST['opcion']) && isset($_POST['valor_busqueda'])) {
  // Conexión a la base de datos
  $conexion = mysqli_connect("localhost", "root", "", "registro");

  // Obtener la opción de búsqueda y el valor de búsqueda
  $opcion = $_POST['opcion'];
  $valor_busqueda = $_POST['valor_busqueda'];

  // Preparar la consulta para buscar registros según la opción seleccionada
  $consulta_buscar = "";
  if ($opcion == "nombre") {
    $consulta_buscar = "SELECT r.*, c.nombre AS nombre_cargo FROM registros r LEFT JOIN cargos c ON r.cargo = c.id WHERE r.nombre LIKE '%$valor_busqueda%'";
  } elseif ($opcion == "telefono") {
    $consulta_buscar = "SELECT r.*, c.nombre AS nombre_cargo FROM registros r LEFT JOIN cargos c ON r.cargo = c.id WHERE r.telefono LIKE '%$valor_busqueda%'";
  } elseif ($opcion == "cargo") {
    $consulta_buscar = "SELECT r.*, c.nombre AS nombre_cargo FROM registros r LEFT JOIN cargos c ON r.cargo = c.id WHERE c.nombre LIKE '%$valor_busqueda%'";
  } elseif ($opcion == "rut") {
    $consulta_buscar = "SELECT * FROM registros WHERE rut LIKE '%$valor_busqueda%'";
  }

  // Ejecutar la consulta de búsqueda
  $resultados_busqueda = mysqli_query($conexion, $consulta_buscar);

  // Mostrar los resultados de la búsqueda
  echo "<!DOCTYPE html>";
  echo "<html lang='es'>";
  echo "<head>";
  echo "<meta charset='UTF-8'>";
  echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
  echo "<link rel='icon' href='favicon.ico'>";
  echo "<title>Resultados de búsqueda</title>";
  echo "<link rel='stylesheet' href='style.css'>";
  echo "</head>";
  echo "<body>";
  echo "<h1>Resultados de búsqueda</h1>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Rut</th>";
  echo "<th>Nombre</th>";
  echo "<th>Teléfono</th>";
  echo "<th>Cargo</th>";
  echo "<th>Acciones</th>";
  echo "</tr>";

  while ($fila_registro = mysqli_fetch_assoc($resultados_busqueda)) {
    echo "<tr>";
    echo "<td>" . $fila_registro['rut'] . "</td>";
    echo "<td>" . $fila_registro['nombre'] . "</td>";
    echo "<td>" . $fila_registro['telefono'] . "</td>";

    if (isset($fila_registro['nombre_cargo'])) {
      echo "<td>" . $fila_registro['nombre_cargo'] . "</td>";
    } else {
      echo "<td>No especificado</td>";
    }

    echo "<td>";
    echo "<a href='editar_registro.php?id=" . $fila_registro['id'] . "'>Editar</a> | ";
    echo "<a href='eliminar_registro.php?id=" . $fila_registro['id'] . "'>Eliminar</a>";
    echo "</td>";
    echo "</tr>";
  }

  echo "</table>";
  echo "</body>";
  echo "</html>";

  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
} else {
  echo "Datos del formulario no válidos.";
}
?>
