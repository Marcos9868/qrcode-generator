<?php

require __DIR__.'/vendor/autoload.php';
use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

// main instance
$objPayload = (new Payload)->setPixKey('12345678900')
                            ->setDescription('Payments')
                            ->setMerchantName('Marcos Melo Ferreira')
                            ->setMerchantCity('WARSAW')
                            ->setAmount(1000.00)
                            ->setTxtId('CODE1234');


// Payment Code
$payloadQrCode = $objPayload->getPayload();

// QR CODE
$obQrCode = new QrCode($payloadQrCode);

// QR Code Image
$qrCodeImage = (new Output\Png)->output($obQrCode, 400);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/global.css">
  <title>Static QR Code</title>
</head>
<body>
  <img src="data:image/png;base64, <?=base64_encode($qrCodeImage) ?>" alt="QR Code">
  <br><br>
  Pix Code:<br>
  <strong><?=$payloadQrCode ?></strong>
</body>
</html>