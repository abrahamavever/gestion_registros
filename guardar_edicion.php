<?php
  // Verificar si se enviaron los datos del formulario
  if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "registro");

    // Obtener los datos del formulario
    $id = $_POST['id'];
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];

    // Consulta para actualizar los datos del registro en la base de datos
    $consulta_actualizar = "UPDATE registros SET rut = '$rut', nombre = '$nombre', telefono = '$telefono', cargo = '$cargo' WHERE id = $id";
    $resultado_actualizar = mysqli_query($conexion, $consulta_actualizar);

    // Verificar si se actualizó el registro correctamente
    if ($resultado_actualizar) {
      echo "Registro actualizado correctamente.";
    } else {
      echo "Error al actualizar el registro.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
  } else {
    echo "Datos del formulario no válidos.";
  }
?>
