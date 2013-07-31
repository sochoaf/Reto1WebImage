
<?php
    include_once getcwd() . '/../Logica/controlador.php';

    $controlador = new Controlador();
    $uploaddir = '../imagenes/';
    $uploadfile = $uploaddir . basename($_FILES['imagenUsuario']['name']);

    echo '<pre>';
    if (move_uploaded_file($_FILES['imagenUsuario']['tmp_name'], $uploadfile)) {
        echo "<h1>La imagen fue subida</h1>\n";    
        $controlador->agregarImagen($_FILES['imagenUsuario']['name']);
    } else {
        echo "<h1>Lo sentimos, hubo un error al procesar tu imagen</h1>\n\n";
    }

    echo "<h1><a href='/../~sochoaf/Reto1WebImage/Presentacion/PaginaPrincipal.html'>Volver</a></h1>\n\n";

    echo 'Mas información aquí:';
    print_r($_FILES);

    print "</pre>";
?>
