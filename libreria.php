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
            
            echo "<option value='".$colonia['Colonia']."'>".$colonia['Colonia']."</option>";
        }
    }
    else{
        echo "<option value=''>No se encontraron resultados</option>";
    }
    $conexion->close();
}
function BuscarMunicipio($codigo_postal, $colonia){
    $conexion = ConexionBD();
    $query = "SELECT Municipio FROM codigospostales WHERE Cp = '$codigo_postal' AND Colonia = '$colonia'";
    $resultado = $conexion->query($query);
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['Municipio'];
    } else {
        return "No se encontraron resultados.";
    }
    $conexion->close();
}
function BuscarEstado($codigo_postal, $colonia){
    $conexion = ConexionBD();
    $query = "SELECT Estado FROM codigospostales WHERE Cp = '$codigo_postal' AND Colonia = '$colonia'";
    $resultado = $conexion->query($query);
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['Estado'];
    } else {
        return "No se encontraron resultados.";
    }
    $conexion->close();
}
?>