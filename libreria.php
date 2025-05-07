<?php
function ConexionBD(){
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $bd = "codigospostales";
    $conexion = new mysqli($servidor, $usuario, $password, $bd);
    if ($conexion->connect_error) {
        die("Error de conexión: ". $conexion->connect_error);
    }
    return $conexion;
}

function ObtenerColonias($codigo_postal){
    $conexion = ConexionBD();
    $resultado=$conexion->query("CALL BuscarCP('$codigo_postal');");
    echo "<option value='' select disabled>Seleccione una colonia</option>";
    if($resultado->num_rows>0){
        while($colonia=$resultado->fetch_assoc()){
            echo "<option value='".$colonia['Cp']."'>".$colonia['Colonia']."</option>";
        }
    }
    else{
        echo "<option value=''>No se encontraron resultados</option>";
    }
    $conexion->close();
}
?>