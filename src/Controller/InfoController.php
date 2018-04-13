<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class InfoController extends BaseController {

  /**
   * @Route("/new-item")
  **/

  public function new(Request $request) {

      $task = new Task("", new \DateTime("today"),"");

      $form = $this->createFormBuilder($task)
        ->add('icon', TextType::class)
        ->add('name', TextType::class)
        ->add('expiration_date', DateType::class)
        ->add('sub', SubmitType::class, ['label'=>'Add to Shopping List'])
        ->add('save', SubmitType::class, ['label'=>'Remove'])
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()){
          print("<prev>" . print_r($form->getData(),true)."</prev>");
        }

      return $this->render('new-item.html.twig', ['task_form' => $form->createView()]);

  }
}
