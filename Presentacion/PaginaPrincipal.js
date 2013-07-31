/**
 * This method triggers when the document is loaded. So after the page is
 * loaded completely, this method will trigger automatically.
 */
$(document).ready(function(){
   
    eventosBotones();
    cargarImagenes();
    cargarFechasCarga();
   
        function eventosBotones() {
            $('#inicio').bind('click', function() {
                $('#registrarse').fadeOut('fast');
                $('#subirImagen').fadeOut('fast');
                $('#iniciarSesion').fadeIn('slow');
            });

            $('#registro').bind('click', function() {
                $('#iniciarSesion').fadeOut('fast');
                $('#subirImagen').fadeOut('fast');
                $('#registrarse').fadeIn('slow');
            });

            $('#botonInicio').bind('click', function() {
                iniciarSesion();
            });

            $('#botonRegistro').bind('click', function() {
                registrarUsuario();
            });
            
            $('#listaFiltro').on('change',function(){
                cargarImagenes();
            });
        }
        
        function registrarUsuario() {
            var params = {
                'evento': 'registrarUsuario',
                'usuario': $('#usuarioRegistro').val(),
                'clave': $('#claveRegistro').val(),
            };

            $.ajax({
                data: params,
                type: "GET",
                url: "../Logica/controlador.php",
                dataType: 'json',
                success: function(json) {
                    switch (json.resultado) {
                        case -1:
                            alert('Error');
                            break;
                        case 0:
                            alert('Todos los campos son obligatorios');
                            break;
                        case 1:
                            alert('Usuario creado. Bienvenido a WebImage!');
                            $('#registrarse').fadeOut('slow');
                            $('#iniciarSesion').fadeIn('slow');
                            break;
                        case 2:
                            alert('El nombre de usuario ya está en uso');
                            break;
                    }
                }
            });
        }
        
        function iniciarSesion() {
            var usuario = $('#usuarioInicio').val();
            var clave = $('#claveInicio').val();

            var params = {
                'evento': 'iniciarSesion',
                'usuario': usuario,
                'clave': clave
            };
            $.ajax({
                data: params,
                type: "GET",
                url: "../Logica/controlador.php",
                dataType: 'json',
                success: function(json) {
                    switch (json.resultado) {
                    case 0:
                        alert('Todos los campos son obligatorios');
                        break;
                    case 1:
                        //Cambia la interfaz
                        $('#inicio').fadeOut('fast');
                        $('#registro').fadeOut('fast');
                        $('#subirImagen').fadeIn('slow');
                        $('#iniciarSesion').fadeOut('slow');
                        break;
                    case 2:
                        alert('El usuario o clave son incorrectos');
                        break;
                    case -1:
                        alert('Error');
                        break;
                    }
                }
            });
        }
        
        function cargarImagenes(){
            var fechaFiltro = $('#listaFiltro').val();
            var params = {
                'evento': 'cargarImagenes',
                'fecha' : fechaFiltro
            };

            $.ajax({
                data: params,
                type: "GET",
                url: "../Logica/controlador.php",
                dataType: 'json',
                success: function(json) {                                                                            
                    var data = json.resultado;
                    if (data !== '') {
                        var str = '';
                        for (var i = 0; i < data.length; i++) {
                            item = data[i]; 
                            str += '<div class="images">';
                            str += '<div><p><a href="../imagenes/'+item.nombreImagen+'" download="'+item.nombreImagen+'" title ="'+item.nombreImgen+'">\n\
                                <img class = "imageDownload" \n\
                                width="250" height="250" src="../imagenes/' 
                                    + item.nombreImagen + '" /></p></div>';                                                                    
                            str += '</div>';
                        }
                        $('#listaImagenes').html(str);
                        //$('#listaFiltro').html(strw);
                    } else {
                        $('#listaImageness').html('');
                    }
                }
            });
        }
        
        function cargarFechasCarga(){
            var params = {
                'evento':'cargarFechasCarga'                
            };
                $.ajax({
                data: params,
                type: "GET",
                url: "../Logica/controlador.php",
                dataType: 'json',
                success: function(json) {                

                    var data = json.resultado;
                    if (data !== '') {
                        var str = '<option value ="Todas">Seleccionar valor</option>';
                        for (var i = 0; i < data.length; i++) {
                            item = data[i]; 
                            str += '<option value="'+item.fechaCarga+'">'+item.fechaCarga +'</option>';                                                                    
                        }
                        $('#listaFiltro').html(str);
                    } else {
                        $('#listaFiltro').html('');
                    }
                }
            });
    
        }
});


