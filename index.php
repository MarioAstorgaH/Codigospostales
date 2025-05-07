<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Codigos Postales</title>
</head>
<body>
    <h1>Busqueda de colonias</h1>
    <div>
    <form action="index.php" method="get">
        <label for="codigo_postal">Codigo Postal:</label>
        <input type="text" 
        id="codigo_postal" 
        name="codigo_postal" 
        required 
        placeholder="Ejemplo: 12345" 
        pattern="\d{5}" 
        value="<?php if (isset($_GET['codigo_postal'])) { echo $_GET['codigo_postal']; } ?>">
        <button type="submit">Buscar</button>
    </form>
    <form action="index.php" method="post">
        <label for="Colonias">Colonias</label>
        <select name="cmboxColonias" id="Colonias">
            <?php
            include 'libreria.php';
            if (isset($_GET['codigo_postal'])) {
                ObtenerColonias($_GET['codigo_postal']);
            }
            else{
                echo "<option value=''select disabled >No hay colonias disponibles</option>";
            }
            ?>
        </select>
        <button type="submit">Enviar</button>
    </form>
        <label for="txtMunicipio">Municipio:</label>
        <output id="txtMunicipio"><?php if (isset($_GET['codigo_postal']) && isset($_GET['cmboxColonias'])) {
                include 'libreria.php';
                $conexion = ConexionBD();
                $codigo_postal = $_POST['codigo_postal'];
                $colonia = $_POST['cmboxColonias'];
                $query = "SELECT Municipio FROM codigospostales WHERE Cp = '$codigo_postal' AND Colonia = '$colonia'";
                $resultado = $conexion->query($query);

                if ($resultado && $resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    echo $fila['Municipio'];
                } else {
                    echo "No se encontraron resultados.";
                }

                $conexion->close();
            } else {
                echo "Seleccione una colonia para ver el municipio.";
            }
        ?></output>
        <label for="">Estado</label>
    </div>
</body>
</html>