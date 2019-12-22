<?php
namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @param TrickRepository $repository
   * @return Response
   */

   public function index(TrickRepository $repository): Response
   {
     $tricks = $repository->findAll();
     dump($tricks);
     return $this->render('pages/home.html.twig', [
       'tricks' => $tricks
     ]);
   }
}
?>
