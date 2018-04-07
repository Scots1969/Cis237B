<?php

namespace App\Entity;

class ProduceItem {

  //properties
  private $name;
  private $expiration_date;
  private $icon;

  function __construct(string $name, \DateTime $expiration_date){
    $this->name = $name;
    $this->expiration_date = $expiration_date;
    
  }

  public function __getName() : string {
    return $this->name;
  }

  public function setName(string $name){
    $this->name = $name;
  }

  public function __getExpirationDate() : \DateTime{
    return $this->expiration_date;
  }

  public function setExpirationDate(\DateTime $expiration_date = null){
    $this->expiration_date = $expiration_date;
  }

}