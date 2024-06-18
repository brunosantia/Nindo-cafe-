<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = $_POST['nombre'] ?? '';
    $mailAddress = $_POST['correo'] ?? '';
    $phone = $_POST['numero'] ?? '';
    $pedidoProductos = $_POST['pedidoProductos'] ?? '';
    $address = $_POST['direccion'] ?? ''; // Supongo que esta variable contiene la dirección de entrega

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'a3520110452@alumno.uttehuacan.edu.mx'; // Cambia esto por tu usuario de SMTP
        $mail->Password = 'gmrjxcjcoftvimlk'; // Cambia esto por tu contraseña de SMTP
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Verificar si la dirección de correo electrónico es válida
        if (filter_var($mailAddress, FILTER_VALIDATE_EMAIL)) {
            // Configuración del remitente y destinatario
            $mail->setFrom($mailAddress, $name);
            $mail->addAddress('a3520110452@alumno.uttehuacan.edu.mx'); // Cambia esto por la dirección de correo del destinatario

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Pedido realizado por ' . $name;
            $mail->Body = "Pedido realizado por: $name <br>" .
                          "Correo electrónico: $mailAddress <br>" .
                          "Teléfono de contacto: $phone <br>" .
                          "Mensaje: $pedidoProductos <br>" .
                          "Dirección de entrega: $address <br>" . // Agregar la dirección al cuerpo del correo
                          "Enviado el: " . date('d/m/Y', time());

            // Envío del correo
            $mail->send();
        
        } else {
            echo 'Error: La dirección de correo electrónico no es válida';
        }
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
