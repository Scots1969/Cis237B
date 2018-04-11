<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Form\TaskType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;




class TaskController extends BaseController{

  /**
   * @Route("/new-task")
   */


  public function new(Request $request) {
    $task = new Task("", new \DateTime("today"),"");

      $form = $this->createForm(TaskType::class, $task);

      $form->handleRequest($request);
      if($form->isSubmitted()) {
        $imageFile = $task->getIcon();
        $fileName = md5(uniqid()) . '.' . $imageFile->guessExtension();
        $rootDirPath = $this->get('kernel')->getRootDir() . '/../public/uploads';
        $imageFile->move($rootDirPath, $fileName);
        $task->setIcon($fileName);

        return new Response(
          '<html><body>New task added: '. $task->getName() . ' on ' . $task->getExpirationDate()->format('Y-m-d') .
          ' Hashed file name: ' . $task->getIcon() . '<img src= "/uploads/' .$task->getIcon() . '"/></body></html>'
        );
      }
      return $this->render('new-task.html.twig' , ['task_form' => $form->createView()]);
  }

}
