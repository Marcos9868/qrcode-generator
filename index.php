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

// Output as data URI
$base64Image = base64_encode($qrCodeImage);

// Output as data URI
echo '<img src="data:image/png;base64,' . $base64Image . '" alt="QR Code">';

echo "<pre>";
print_r($objPayload);
print_r($payloadQrCode);
echo "<pre>"; exit;