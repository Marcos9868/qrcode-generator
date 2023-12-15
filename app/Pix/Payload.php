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
   * @param string $amount
  */
  public function setAmount($amount) {
    $this->amount = $amount;
    return $this;
  }
}