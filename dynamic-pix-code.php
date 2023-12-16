<?php

require __DIR__.'/vendor/autoload.php';
use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/global.css">
  <title>Dynaminc QR Code</title>
</head>
<body>
  <img src="data:image/png;base64, <?=base64_encode($qrCodeImage) ?>" alt="QR Code">
  <br><br>
  Pix Code:<br>
  <strong><?=$payloadQrCode ?></strong>
</body>
</html> -->