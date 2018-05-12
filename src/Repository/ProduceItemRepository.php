<?php

namespace App\Repository;

use App\Entity\ProduceItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
class ProduceItemRepository extends ServiceEntityRepository{

  public function __construct(RegistryInterface $registry) {
    parent:: __construct($registry, ProduceItem::class);
  }

  public function  getShoppingListItems() {
    return $this->getEntityManager()
    ->createQuery('SELECT * FROM smart_shopping_list.produce_item')
    ->getResult();
  }
  public function  getRefrigeratorItems() {
    return $this->getEntityManager()
    ->createQuery('')
    ->getResult();
  }



}
