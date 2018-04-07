<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/new-task")
 */


class TaskController extends BaseController{

  public function new() {
    $task = new Task("Need to wash the dishes!", new \DateTime("today"));

    $form = $this->createFormBuilder($task)
      ->add('description', TextType::class)
      ->add('dueDate', DateType::class)
      ->add('save', SubmitType::class, ['label' => 'Create new Task'])
      ->getForm();


    return $this->render('new-task.html.twig', ['task_form' => $form->createView()]);
  }

}
