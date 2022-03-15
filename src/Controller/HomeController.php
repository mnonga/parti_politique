<?php

namespace App\Controller;

use App\Entity\Cellule;
use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'LipaController',
        ]);
    }

    /**
     * @Route("/api/stats", name="api.membres.stats")
     */
    public function test(MembreRepository $repository): Response
    {
        return $this->json($repository->getEffectifByCellule());
    }
}
