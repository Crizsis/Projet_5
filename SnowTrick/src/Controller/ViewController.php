<?php
namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{

  public function __construct(TrickRepository $repository)
  {
    $this->repository = $repository;
  }
  /**
   * @Route ("figures/{name}-{id}", name="figures.view", requirements={"slug": "[a-z0-9\-]*" })
   * @return Response
   */
  public function show($name, $id): Response
  {
    $trick = $this->repository->find($id);
    return $this->render('figures/view.html.twig',[
      'trick' => $trick
    ]);
  }
}
?>
