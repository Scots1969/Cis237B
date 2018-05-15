<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProduceItem;
use App\Form\ProduceItemType;
use App\Form\TaskType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


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
        $ProduceItem->setInShoppingList('True');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ProduceItem);
        $entityManager->flush();

        return new Response(
          '<html><body>New task added: id'. $ProduceItem->getName() . ' on ' . $ProduceItem->getExpirationDate()->format('Y-m-d') .
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

    //var_dump($ProduceItem);
    return $this->render('list.html.twig', ['ProduceItem' => $ProduceItem]);

  }

  /**
   * @Route("/produce/{id}", name="get_produce")
   * @Method("GET")
   */

  public function getProduceItem(int $id) {

    $repo = $this->getDoctrine()->getRepository(ProduceItem::class);
    $produce = $repo->find($id);

    return $this->render('list.html.twig', ['ProduceItem' => $produce]);
}
  /**
   * @Route("/produce/{id}", name="delete_produce")
   * @Method("DELETE")
   */

  public function deleteItem(int $id){

    $repo = $this->getDoctrine()->getRepository(ProduceItem::class);
    $produce = $repo->find($id);

    $em = $this->getDoctrine()->getManager();
    $em->remove($produce);
    $em->flush();

    return new JsonResponse([], Response::HTTP_NO_CONTENT);

  }

  /**
   *@Route("/produce/{id}/edit", name="edit_produce")
   */

  public function editProduceItem(int $id, Request $request) {

    $repo = $this->getDoctrine()->getRepository(ProduceItem::class);
    $produce = $repo->find($id);

    $form = $this->createForm(TaskType::class,$ProduceItem);



    $form->handleRequest($request);
    if($form->isSubmitted()) {

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($ProduceItem);
      $entityManager->flush();

      return new Response(
        'Produce '. $ProduceItem->getId(). ' was updated'
      );

      //  return $this->render('list.html.twig', [ 'form' => $form => createView(), 'label' =>'Add Item']);
  }

}

/**
 * @Route("/produce/{id}/edit", name="ajax_edit_produce")
 * @Method("PUT")
 */

public function ajaxEditStudent(int $id, Request $request){

    $produce = $this->getDoctrine()->getRepository(ProduceItem::class)->find($id);

    $data = request->request->all();

    $form = $this->createForm(TaskType::class,$ProduceItem);
    $form->submit(data);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($ProduceItem);
    $entityManager->flush();

    return new JsonResponse([], Response::HTTP_OK);

}

/**
 * @Route("produceitem/download", name="List_download")
 */
public function download() {

  $repository = $this->getDoctrine()->getRepository(ProduceItem::class);
  $ProduceItem = $repository->findAll();
  $fileName = 'Shopping_list.txt';

  $fp = fopen($filename, 'w');

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

return $this->file->file('Shopping_list.txt')
