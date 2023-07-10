<?php
  // Conexión a la base de datos
  $conexion = mysqli_connect("localhost", "root", "", "registro");

  // Consulta para eliminar todos los registros de la base de datos
  $consulta_eliminar_todos = "DELETE FROM registros";
  $resultado_eliminar_todos = mysqli_query($conexion, $consulta_eliminar_todos);

  // Verificar si se eliminaron todos los registros correctamente
  if ($resultado_eliminar_todos) {
    echo "Todos los registros han sido eliminados.";
  } else {
    echo "Error al eliminar todos los registros.";
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
?>
