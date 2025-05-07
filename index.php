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
        pattern="[0-9]{5}"
        value="<?php if (isset($_GET['codigo_postal'])) { echo $_GET['codigo_postal']; } ?>">
        <button type="submit">Buscar</button>
    </form>
    <form action="index.php" method="get">
        <input type="hidden" name="codigo_postal" value="<?php if (isset($_GET['codigo_postal'])) { echo $_GET['codigo_postal']; } ?>">
        <label for="Colonias">Colonias</label>
        <select name="cmboxColonias" id="Colonias" select="<?php if (isset($_GET['cmboxColonias'])) { echo $_GET['cmboxColonias']; } ?>">
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
        <output id="txtMunicipio"><?php 
            if (isset($_GET['codigo_postal']) && isset($_GET['cmboxColonias'])) {
                echo BuscarMunicipio($_GET['codigo_postal'], $_GET['cmboxColonias']);
            }
        ?></output><br>
        <label for="lblEstado">Estado: </label>
        <output id="lblEstado"><?php 
        if (isset($_GET['codigo_postal']) && isset($_GET['cmboxColonias'])) {
            echo BuscarEstado($_GET['codigo_postal'], $_GET['cmboxColonias']);
        }
        ?></output>
    </div>
</body>
</html>