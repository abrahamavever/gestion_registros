<?php
  // Conexión a la base de datos
  $conexion = mysqli_connect("localhost", /*usuario*/"root", /*contraseña*/"", "registro");

  // Obtener los datos enviados por el formulario
  $rut = $_POST['rut'];
  $nombre = $_POST['nombre'];
  $telefono = $_POST['telefono'];
  $cargo = $_POST['cargo'];

  // Consulta para insertar los datos en la base de datos
  $consulta_insertar = "INSERT INTO registros (rut, nombre, telefono, cargo) VALUES ('$rut', '$nombre', '$telefono', '$cargo')";
  $resultado_insertar = mysqli_query($conexion, $consulta_insertar);

  if ($resultado_insertar) {
    echo "Registro guardado correctamente.";
  } else {
    echo "Error al guardar el registro.";
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
?>
