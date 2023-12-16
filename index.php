<?php

require __DIR__.'/vendor/autoload.php';
use \App\Pix\Payload;

$objPayload = (new Payload)->setPixKey('12345678900')
                            ->setDescription('Payments')
                            ->setMerchantName('Marcos Melo Ferreira')
                            ->setMerchantCity('WARSAW')
                            ->setAmount(1000.00)
                            ->setTxtId('CODE1234');


$payloadQrCode = $objPayload->getPayload();
echo "<pre>";
print_r($objPayload);
print_r($payloadQrCode);
echo "<pre>"; exit;