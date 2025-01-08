<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $service = htmlspecialchars($_POST['service']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'manzanoscarwash@gmail.com';
        $mail->Password = 'Manzanoscarwash2024';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('jara_santiagodavid@hotmail.com');
        $mail->Subject = 'Nueva solicitud de servicio o suscripción';
        $mail->Body = "Nombre: $name\nCorreo: $email\nServicio o Suscripción: $service\nMensaje: $message";

        $mail->send();

        header("Location: index.html"); // Redirige al home en caso de éxito
        exit();
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}"; // Muestra el error
    }
} else {
    header("Location: index.html"); // Redirige al home si se accede directamente
    exit();
}
?>
