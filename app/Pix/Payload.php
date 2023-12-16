<?php

namespace App\Pix;

class Payload {
  /** 
   * PIX Payload ID's
  */
  const ID_PAYLOAD_FORMAT_INDICATOR = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
  const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
  const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
  const ID_MERCHANT_ACCOUNT_INFORMATION_KEY_DESCRIPTION = '02';
  const ID_MERCHANT_CATEGORY_CODE = '52';
  const ID_TRANSACTION_CURRENCY = '53';
  const ID_TRANSACTION_AMOUNT = '54';
  const ID_COUNTRY_CODE = '58';
  const ID_MERCHANT_NAME = '59';
  const ID_MERCHANT_CITY = '59';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
  const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXTID = '05';
  const ID_CRC16 = '05';

  /**
  * Pix Key
  * @var string
  */
  private $pixKey;

  /**
  * Payment Description
  * @var string
  */
  private $description;

  /**
  * Account person name
  * @var string
  */
  private $merchantName;
  
  /**
  * Account Person City
  * @var string
  */
  private $merchantCity;
  
  /**
  * Pix Id Transaction
  * @var string
  */
  private $txtId;
  
  /**
  * Transaction Value
  * @var string
  */
  private $amount;

  /**
   * Method that define pixKey value
   * @param string $pixKey 
  */
  public function setPixKey($pixKey) {
    $this->pixKey = $pixKey;
    return $this;
  }

  /**
   * Method that set description value
   * @param string $description 
  */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }
  
  /**
   * Method that set merchantName value
   * @param string $merchantName 
  */
  public function setMerchantName($merchantName) {
    $this->merchantName = $merchantName;
    return $this;
  }
  
  /**
   * Method that set merchantCity value
   * @param string $merchantCity 
  */
  public function setMerchantCity($merchantCity) {
    $this->merchantCity = $merchantCity;
    return $this;
  }
  
  /**
   * Method that set txtId value
   * @param string $txtId
  */
  public function setTxtId($txtId) {
    $this->txtId = $txtId;
    return $this;
  }

  /**
   * Method that set amount value
   * @param float $amount
  */
  public function setAmount($amount) {
    $this->amount = (string)number_format($amount, 2, '.', '');
    return $this;
  }

  /**
   * Method that returns full object value of payload
   * @param string $id
   * @param string $value
   * @return string $id.$size.$value
  */
  private function getValue($id, $value) {
    $size = str_pad(strlen($value), 2, '0', STR_PAD_LEFT);

    return $id.$size.$value;
  }

  /**
   * Method that return full account information values
   * @return string
  */
  private function getMerchantAccountInformation() {
    // Bank Domain
    $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, 'br.gov.bcb.pix');
    // Pix Key
    $key = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->pixKey);
    // Payment Description
    $description = strlen($this->description) ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY_DESCRIPTION, $this->description) : '';

    return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION, $gui.$key.$description);
  }

  /**
   * Method that return full additional field value (TXTID)
   * @return string 
  */
  private function getAdditionDataFieldTemplate() {
    // txtid
    $txtid = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXTID, $this->txtId);

    return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE, $txtid);
  }

  private function getCRC16($payload) {
    // Add main payload data
    $payload .= self::ID_CRC16. '04';

    // Bacen default data
    $polinomius = 0x1021;
    $result = 0xFFFF;

    // Checksum
    if ($length = strlen($payload) > 0) {
      for ($offset = 0; $offset < $length; $offset++) {
        $result ^= (ord($payload[$offset]) << 8);
        for ($bitwise = 0; $bitwise < 8; $bitwise++) {
          if (($result <<= 1) & 0x10000) $result ^= $polinomius;
          $result &= 0xFFFF;
        }
      }
    }

    return self::ID_CRC16. '04'.strtoupper(dechex($result));
  }
  
  /**
   * Method that generate pix code
   * @return string
  */
  public function getPayload() {
    // Creates payload
    $payload = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR, '01').
               $this->getMerchantAccountInformation().
               $this->getValue(self::ID_MERCHANT_CATEGORY_CODE, '0000').
               $this->getValue(self::ID_TRANSACTION_CURRENCY, '986').
               $this->getValue(self::ID_TRANSACTION_AMOUNT, $this->amount).
               $this->getValue(self::ID_COUNTRY_CODE, 'BR').
               $this->getValue(self::ID_MERCHANT_NAME, $this->merchantName).
               $this->getValue(self::ID_MERCHANT_CITY, $this->merchantCity).
               $this->getAdditionDataFieldTemplate();
    
    // Return payload + CRC16
    return $payload.$this->getCRC16($payload);
  }
}