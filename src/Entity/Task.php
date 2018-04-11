<?php

namespace App\Entity;

class Task {

  //properties
  public $name;
  public $expiration_date;
  public $icon;

  function __construct(string $name, \DateTime $expiration_date, $icon){
    $this->name = $name;
    $this->expiration_date = $expiration_date;
    $this->icon = $icon;
  }

  public function getName() : string {
    return $this->name;
  }

  public function setName(string $name){
    $this->name = $name;
  }

  public function getExpirationDate() : \DateTime{
    return $this->expiration_date;
  }

  public function setExpirationDate(\DateTime $expiration_date = null){
    $this->expiration_date = $expiration_date;
  }

  public function getIcon() {
    return $this->icon;
  }

  public function setIcon($icon){
    $this->icon = $icon;
  }
}
