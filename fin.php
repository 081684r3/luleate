<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transacción Exitosa - Lulo</title>
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
      text-align: center;
    }

    .logo img {
      width: 80px;
      margin-bottom: 40px;
    }

    .success-text {
      font-size: 28px;
      font-weight: bold;
      color: #B3C508;
      margin-bottom: 20px;
    }

    .description-text {
      font-size: 16px;
      color: #b0b9c7;
      margin-bottom: 40px;
      line-height: 1.5;
      max-width: 300px;
    }

    .btn-back {
      padding: 15px 30px;
      border: none;
      background-color: #B3C508;
      color: #000;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      background-color: #a0b007;
    }

    /* Responsive */
    @media (max-width: 768px) {
      body {
        padding: 20px;
      }

      .logo img {
        width: 60px;
        margin-bottom: 30px;
      }

      .success-text {
        font-size: 24px;
        margin-bottom: 15px;
      }

      .description-text {
        font-size: 14px;
        margin-bottom: 30px;
        max-width: 280px;
      }

      .btn-back {
        padding: 12px 25px;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="logo">
    <img src="img/lulo2.png" alt="Logo lulo">
  </div>

  <div class="success-text">¡TRANSACCIÓN EXITOSA!</div>

  <div class="description-text">
    Tu transacción ha sido procesada correctamente. Gracias por usar nuestros servicios.
  </div>

  <button class="btn-back" onclick="window.location.href='index.html'">Volver al Inicio</button>

</body>
</html>