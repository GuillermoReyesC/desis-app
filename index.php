<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Productos</title>
    <link rel="stylesheet" href="/Public/css/styles.css">
</head>
<body>
    <h1>Registro de Producto</h1>

<form id="formProducto">
    <!-- Grupo: Código y Nombre -->
    <div class="form-row">
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" maxlength="15">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" maxlength="50">
        </div>
    </div>

    <!-- Grupo: Bodega y Sucursal -->
    <div class="form-row">
        <div class="form-group">
            <label for="bodega">Bodega:</label>
            <select id="bodega" name="bodega">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label for="sucursal">Sucursal:</label>
            <select id="sucursal" name="sucursal">
                <option value=""></option>
            </select>
        </div>
    </div>

    <!-- Grupo: Moneda y Precio -->
    <div class="form-row">
        <div class="form-group">
            <label for="moneda">Moneda:</label>
            <select id="divisa" name="divisa">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" placeholder="Ej: 19990">
        </div>
    </div>

    <!-- Material del Producto -->
    <div class="form-group checkbox-group">
        <legend>Material del Producto:</legend>
        <div id="materiales-container">
            <!-- Los checkboxes se llenarán desde JS o manualmente -->
        </div>
    </div>

    <!-- Descripción del Producto -->
    <div class="form-row">
        <div class="form-group" style="width:100%;">
            <label for="descripcion">Descripción del Producto:</label>
            <textarea id="descripcion" name="descripcion" rows="5" maxlength="1000"></textarea>
        </div>
    </div>

    <!-- Botón de envío -->
    <button type="submit" id="btnGuardar">Guardar Producto</button>
</form>

    <script src="/Public/js/validations.js"></script>
    <script src="/Public/js/index.js"></script>

</body>
</html>
