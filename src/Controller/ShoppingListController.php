<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProduceItem;
use App\Form\TaskType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class ShoppingListController extends BaseController{


  /**
   * @Route("produceitem/download", name="list_download")
   */
  public function download() {

    $repository = $this->getDoctrine()->getRepository(ProduceItem::class);
    $ProduceItem = $repository->findAll();
    $fileName = 'Shopping_list.txt';

    $fp = fopen($fileName, 'w');

    $content = '';

    foreach($ProduceItem as $produce) {
      $fn = $produce->getName();
      $ln = $produce->getExpirationDate();
      $ic =  $produce->getIcon();
      $content .="$fn $ln $ic:\n";
    }
  }

  fwrite($fp, $content);
  fclose($fp);

  return $this->file->file($fileName)

}
