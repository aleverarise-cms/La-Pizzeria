<?php

function lapizzeria_eliminar()
{
    if (isset($_POST['tipo'])) {
        if ($_POST['tipo'] == 'eliminar') {

            global $wpdb;
            $tabla       = $wpdb->prefix . 'reservaciones';
            $id_registro = $_POST['id'];
            $resultado = $wpdb->delete($tabla, array('id' => $id_registro), array('%d'));

            if($resultado == 1){
            	$respuesta = array(
            		'respuesta' => 1,
            		'id' => $id_registro
            	);
            }else{
            	$respuesta = array(
            		'respuesta' => 'error',
            	);
            }
        }
    }
    die(json_encode($respuesta));
}
add_action('wp_ajax_lapizzeria_eliminar', 'lapizzeria_eliminar');

function lapizzeria_guardar()
{

    if (isset($_POST['enviar']) && isset($_POST['oculto']) && $_POST['oculto'] == "1") {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $captcha = $_POST['g-recaptcha-response'];

            // CAMPOS QUE DEBEN ENVIARSE
            $campos = array(
                'secret' => '6Ld-vkgUAAAAAFp7ljr0MLkdmMP-vaZ0EYgB5-4z',
                'response' => $captcha,
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            );

            // INICIAR SESION EN CURLS
            // CURL ES UTILIZADO PARA ACCEDER A SERVIDORES REMOTOS
            
            // INICIAR
            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            // CUERPO
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 150);
            // GENERA UNA CADENA CODIFICADA PARA LA URL
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($campos));

            // OBTENER RESPUESTA
            $respuesta = json_decode(curl_exec($ch));

            if($respuesta->success){
                global $wpdb;
                    $tabla = $wpdb->prefix . "reservaciones";

                $nombre   = sanitize_text_field($_POST['nombre']);
                $fecha    = sanitize_text_field($_POST['fecha']);
                $correo   = sanitize_text_field($_POST['correo']);
                $telefono = sanitize_text_field($_POST['telefono']);
                $mensaje  = sanitize_text_field($_POST['mensaje']);

                $datos = array(
                    'nombre'   => $nombre,
                    'fecha'    => $fecha,
                    'correo'   => $correo,
                    'telefono' => $telefono,
                    'mensaje'  => $mensaje,
                );

                $formato = array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                );

                $wpdb->insert($tabla, $datos, $formato);

                $url = get_page_by_title('Gracias por su reserva');
                wp_redirect(get_permalink($url->ID));
                exit();
            }
        }
    }
}
add_action('init', 'lapizzeria_guardar');
