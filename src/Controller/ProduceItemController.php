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




class ProduceItemController extends BaseController{

  /**
   * @Route("/new-task")
   */


  public function new(Request $request) {
    $ProduceItem = new ProduceItem("", new \DateTime("today"),"");

      $form = $this->createForm(TaskType::class,$ProduceItem);



      $form->handleRequest($request);
      if($form->isSubmitted()) {
        $imageFile = $ProduceItem->getIcon();
        $fileName = md5(uniqid()) . '.' . $imageFile->guessExtension();
        $rootDirPath = $this->get('kernel')->getRootDir() . '/../public/uploads';
        $imageFile->move($rootDirPath, $fileName);
        $ProduceItem->setIcon($fileName);

        return new Response(
          '<html><body>New task added: '. $ProduceItem->getName() . ' on ' . $ProduceItem->getExpirationDate()->format('Y-m-d') .
          ' Hashed file name: ' . $ProduceItem->getIcon() . '<img src= "/uploads/' .$ProduceItem->getIcon() . '"/></body></html>'
        );
      }
      return $this->render('new-task.html.twig' , ['task_form' => $form->createView()]);
  }

  /**
   *@Route("/list-items")
   */
  public function list() {

    $repository = $this->getDoctrine()->getRepository(ProduceItem::class);
    $ProduceItem = $repository->findAll();
    

    return $this->render('list.html.twig', ['students' => $ProduceItem]);

  }

}
