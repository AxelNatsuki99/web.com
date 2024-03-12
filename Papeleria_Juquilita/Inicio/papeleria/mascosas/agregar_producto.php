<?php
include 'database.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $precio = $_POST['precio'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO libretas (nombre, precio) VALUES ('$nombre', '$precio')";
    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado correctamente";
    } else {
        echo "Error al agregar producto: " . $conn->error;
    }
}

// Consulta para obtener todos los productos
$sql = "SELECT * FROM libretas";
$resultado = $conn->query($sql);

// Muestra los productos
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<span class='titulo-item'>" . $row['nombre'] . "</span>";
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
