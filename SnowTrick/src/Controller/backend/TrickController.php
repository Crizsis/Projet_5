<?php
namespace App\Controller\backend;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{

  /**
  * @var TrickRepository
  */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(TrickRepository $repository, EntityManagerInterface $em)
    {
      $this->repository = $repository;
      $this->em           = $em;
    }


    /**
     * @Route("user/create", name="user.trick.new")
     * @param Trick $trick
     */
     public function new(Request $request)
     {
       $trick = new Trick();
       $form = $this->createForm(TrickType::class, $trick);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid())
       {
         $this->em->persist($trick);
         $this->em->flush();
         $this->addFlash('success', 'Le trick à bien été ajouté');
         return $this->redirectToRoute('home');
       }

       return $this->render('user/trick/new.html.twig', [
         'trick' => $trick,
         'form' => $form->createView()
       ]);

     }

    /**
    * @Route("user/trick/{id}", name="user.trick.edit", methods="GET|POST")
    * @param Trick $trick
    * @return \Symfony\Component\HttpFoundation\Response
    */

    public function edit(Trick $trick, Request $request)
    {
      $form = $this->createForm(TrickType::class, $trick);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $this->em->flush();
        return $this->redirectToRoute('home');
        $this->addFlash('success', 'Le trick à bien été modifié');
      }

      return $this->render('user/trick/edit.html.twig', [
        'trick' => $trick,
        'form' => $form->createView()
      ]);
    }
    /**
    * @Route("user/trick/{id}", name="user.trick.delete", methods="DELETE")
    * @param Trick $trick
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function delete(Trick $trick, Request $request)
    {
      if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->get('_token')))
      {
        $this->em->remove($trick);
        $this->em->flush();
        $this->addFlash('success', 'Le trick à bien été supprimé');
      }
      return $this->redirectToRoute('home');
    }
}

?>
