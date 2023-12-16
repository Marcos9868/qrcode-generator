<?php

namespace App\Pix;

class Api {
  /**
   * Base URL PSP
   * @var string
  */
  private $baseUrl;

  /**
   * PSP Client Id OAuth2
   * @var string 
  */
  private $clientId;
  
  /**
   * PSP Client Secret OAuth2
   * @var string 
  */
  private $clientSecret;
  
  /**
   * absolute path to certificate file
   * @var string 
  */
  private $certificate;

  /**
   * @param string $baseUrl
   * @param string $clientId
   * @param string $clientSecret
   * @param string $certificate
  */
  public function __construct($baseUrl,$clientId,$clientSecret,$certificate) {
    $this->baseUrl = $baseUrl;
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
    $this->certificate = $certificate;
  }
}