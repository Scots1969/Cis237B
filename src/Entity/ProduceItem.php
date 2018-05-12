<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Icon;

/**
* @ORM\Entity(repositoryClass="App\Repository\ProduceItemRepository")
*/
class ProduceItem {

  //properties

  /**
  * One ProduceItem has One Icon
  * @ORM\OneToOne(targetEntity="Icon")
  * @ORM\JoinColumn(name="Icon")
  * @ORM\Id
  * @ORM\GeneratedValue
  * @ORM\Column(type="integer")
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=50)
  */
  private $name;

  /**
   *@ORM\Column(type="datetime", name="expiration_date")
  */
  private $expiration_date;

  /**
  * @ORM\Column(type="string", length=50)
  */
  private $icon;

  /**
  * @ORM\Column(type="boolean")
  */
  private $in_shopping_list;

  function __construct(string $name, \DateTime $expiration_date, $icon){

    $this->name = $name;
    $this->expiration_date = $expiration_date;
    $this->icon = $icon;
  }

  public function getId() {
    return $this->id;
  }

  public function setId(string $id){
    $this->id = $id;
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

  public function getIcon()  {
    return $this->icon;
  }

  public function setIcon($icon){
    $this->icon = $icon;
  }

  public function getIn_shopping_list() : bool {
    return $this->in_shopping_list;
  }

  public function setIn_shopping_list(bool $in_shopping_list){
    $this->in_shopping_list = $in_shopping_list;
  }

}
