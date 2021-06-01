<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/public/');
        $propiedad = Propiedad::find($id);

        if (is_null($propiedad))
            header("Location: /public/propiedades");

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Instantiation and passing `true` enables exceptions
            $respuestas = $_POST['contacto'];
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '6183892eb1c76b';                     //SMTP username
                $mail->Password   = 'dc76e9e4748836';                               //SMTP password
                $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 2525;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('admin@bienesraices.com');
                $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');     //Add a recipient
                $mail->Subject = 'Nueva solicitud de '. $respuestas['tipo'];
                
                //Content
                $contenido = '<html>';
                $contenido .= '<p>Tienes un nuevo mensaje</p>';
                $contenido .= '<p>Nombre: ' .$respuestas['nombre']. '</p>';
                $contenido .= '<p>Email: ' .$respuestas['email']. '</p>';
                $contenido .= '<p>Teléfono: ' .$respuestas['telefono']. '</p>';
                $contenido .= '<p>Mensaje: ' .$respuestas['mensaje']. '</p>';
                $contenido .= '<p>Vende o compra: ' .$respuestas['tipo']. '</p>';
                $contenido .= '<p>Precio o presupuesto: $' .$respuestas['precio']. '</p>';
                $contenido .= '<p>Prefiere ser contactado por: ' .$respuestas['contacto']. '</p>';
                $contenido .= '<p>Fecha Contacto:' .$respuestas['fecha']. '</p>';
                $contenido .= '<p>Hora:' .$respuestas['hora']. '</p>';
                $contenido .= '</html>';

                $mail->isHTML(true);  //Set email format to HTML
                $mail->CharSet = 'UTF-8';                                
                $mail->Body    = $contenido;
                $mail->AltBody = 'Esto es texto alternativo sin HTML';

                $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        $router->render('paginas/contacto', []);
    }
}
