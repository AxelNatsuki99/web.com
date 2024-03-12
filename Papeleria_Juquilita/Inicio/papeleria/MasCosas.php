<form id="agregarProductoForm" action="mascosas/agregar_producto.php" method="post">
    <div class="mb-3">
        <label for="nombreProducto" class="form-label">Nombre del Producto</label>
        <input type="text" class="form-control" id="nombreProducto" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="precioProducto" class="form-label">Precio del Producto</label>
        <input type="number" class="form-control" id="precioProducto" name="precio" step="0.01" required>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Producto</button>
</form>
