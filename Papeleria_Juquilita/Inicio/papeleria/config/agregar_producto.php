<?php
include 'database.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = $_POST['precio'];

    // Procesar imagen
    $imagen = $_FILES['imagen']['name'];
    $imagen_temporal = $_FILES['imagen']['tmp_name'];
    $ruta_imagen = "C:/wamp64/www/Papeleria_Juquilita/Inicio/papeleria/img/$imagen"; // Ruta completa donde se guardarán las imágenes

    // Mueve la imagen al directorio de destino
    if (move_uploaded_file($imagen_temporal, $ruta_imagen)) {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO productos (nombre, precio, imagen) VALUES ('$nombre', '$precio', '$ruta_imagen')";
        if ($conn->query($sql) === TRUE) {
            echo "Producto agregado correctamente";
        } else {
            echo "Error al agregar producto: " . $conn->error;
        }
    } else {
        echo "Error al mover el archivo al directorio de destino";
    }
}

// Consulta para obtener todos los productos actualizada
$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

// Muestra los productos
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<span class='titulo-item'>" . $row['nombre'] . "</span>";
        echo "<img src='" . $row['imagen'] . "' alt='' class='img-item'>";
        echo "<span class='precio-item'>$" . $row['precio'] . "</span>";
        echo "<button class='boton-item'>Agregar al Carrito</button>";
        
        echo "</div>";
    }
} else {
    echo "No hay productos disponibles";
}

// Cerrar conexión
$conn->close();
?>