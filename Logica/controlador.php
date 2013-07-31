    <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once getcwd() . '/connection.php';
//Se obtienen las variables pasadas en la llamada desde el HTML y el JS
@$evento = $_GET['evento'];
@$usuario = $_GET['usuario'];
@$clave = $_GET['clave'];
@$nombreImagen = $_GET['nombreImagen'];
@$fecha = $_GET['fecha'];


$controlador = new Controlador();
if($evento == 'iniciarSesion'){
    $resultado = array('resultado' => $controlador->iniciarSesion($usuario, $clave));
    echo json_encode($resultado);
}else if ($evento == 'registrarUsuario'){
    $resultado = array('resultado' => $controlador->registrarUsuario($usuario, $clave));
    echo json_encode($resultado);
}else if($evento == 'cargarImagenes'){  
    $resultado = array('resultado' => $controlador->cargarImagenes($fecha));
    echo json_encode($resultado);
}else if($evento == 'agregarImagen'){  
    $resultado = array('resultado' => $controlador->agregarImagen($nombreImagen, $usuario));
    echo json_encode($resultado);
}else if($evento == 'cargarFechasCarga'){
    $resultado = array('resultado' => $controlador->cargarFechas());
    echo json_encode($resultado);
}

class Controlador {

    public function iniciarSesion($usuario, $clave){
        
        if($usuario == null || $clave == null){
            //Empty Fields
            return 0;
        }
        
        $enunciado = "SELECT * FROM Authentication WHERE username ='".$usuario."'";
        $consulta = mysql_query($enunciado);               
                 
        if(!$consulta){
            //Hubo un error al ejecutar la consulta
            return -1;           
        }      
        
        if(mysql_num_rows($consulta) == 0){
            //Si no recupero registros, es porque el usuario no existe
            return 2;
        }else{
            //Se pasa a revisar la clave
            if(mysql_result($consulta, 0,'password') == $clave){
                return 1;
            }else{
                return 2;
            }
        }
          
    }
    
    public function registrarUsuario($usuario, $clave) {
        if ($usuario == null || $clave == null) {
            return 0;
        }
        $enunciado = "SELECT * FROM Authentication WHERE username ='".$usuario."'";
        $consulta = mysql_query($enunciado);               
                 
        if(!$consulta){
            return -1;           
        }      
        if(mysql_num_rows($consulta) == 0){
            $enunciado = "INSERT INTO `Authentication` (`username` , `password`) VALUES ('".$usuario."' , '". $clave."')";
            $consulta = mysql_query($enunciado);

            if (!$consulta) {
                return -1;
            } else {
                return 1;
            }
        }else{
            return 2;
        }
    }

    public function agregarImagen($nombreImagen){
        if($nombreImagen == null){
            return 0;
        }
        $enunciado = "INSERT INTO `imagenes` (`idImagen` , `nombreImagen` )VALUES (NULL , '".$nombreImagen."')";
        $consulta = mysql_query($enunciado);        
        
        if(!$consulta){
            return -1;
        }else{ 
            return 1;
        }
    }
    
    public function cargarImagenes($fecha){
        $enunciado = '';
        if($fecha == null || $fecha == "Todas"){
            $enunciado = "SELECT nombreImagen FROM `imagenes`";
        }else{
            $enunciado = "SELECT nombreImagen FROM `imagenes` where fechaCarga ='".$fecha."'";
        }
        $consulta = mysql_query($enunciado);
        if(!$consulta){
            return -1;
        }else{ 
            $imagenes = array();
            while($registro = mysql_fetch_array($consulta)){
                array_push($imagenes, $registro);
            }
            return $imagenes;                        
        }
    }
    
    public function cargarFechas(){
        $enunciado = "SELECT DISTINCT fechaCarga FROM `imagenes`";
        $consulta = mysql_query($enunciado);
        if(!$consulta){
            return -1;
        }else{ 
            $fechas = array();
            while($registro = mysql_fetch_array($consulta)){
                array_push($fechas, $registro);
            }
            return $fechas;                        
        }
    }

}

?>
