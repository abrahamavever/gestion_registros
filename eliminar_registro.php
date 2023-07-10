<?php
  // Verificar si se proporciona un ID válido en la URL
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "registro");

    // Obtener el ID del registro a eliminar
    $id = $_GET['id'];

    // Consulta para eliminar el registro de la base de datos
    $consulta_eliminar = "DELETE FROM registros WHERE id = $id";
    $resultado_eliminar = mysqli_query($conexion, $consulta_eliminar);

    // Verificar si el registro se eliminó correctamente
    if ($resultado_eliminar) {
      echo "Registro eliminado correctamente.";
    } else {
      echo "Error al eliminar el registro.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
  } else {
    echo "ID de registro no válido.";
  }
?>
