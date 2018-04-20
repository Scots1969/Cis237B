<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InfoController extends BaseController {

  /**
   * @Route("/new-item")
  **/

  public function new(Request $request) {

      $task = new Task("", new \DateTime("today"),"");

      $form = $this->createFormBuilder($task);

      $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form->isSubmitted()){
        
          $task = $form->getData();
          return new Response(
            '<html><body>New task was added: ' . $task->getName() . ' on ' . $task->getExpirationDate()->format('Y-m-d') . '</body></html>'
          );
        }

      return $this->render('new-item.html.twig', ['task_form' => $form->createView()]);

  }
}
