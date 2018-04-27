<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Icon;
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

      $task = new Icon("");

      $form = $this->createFormBuilder($task);

      $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form->isSubmitted()){
          $entityManager = $this->getDoctrine()->getManager();
          $entityMnaager->persist();
          $entityManager->flush();


          return new Response(
            '<html><body>New Icon was added: ' . $task->getIcon . '</body></html>'
          );
        }

      return $this->render('new-item.html.twig', ['task_form' => $form->createView()]);
  }

  /**
   *@Route("/list-icons")
   */
  public function list() {
    $repository = $this->getDoctrine()->getRepository(Icon::class);
    $Icon = $repository->findAll();
    var dump($Icon);

    return $this->render('listIcon.html.twig', ['task' => $Icon]);
  }
}
