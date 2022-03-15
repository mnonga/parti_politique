<?php

namespace App\Controller;

use App\Entity\Cellule;
use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LipaController extends AbstractController
{
    /**
     * @Route("/", name="membres.index")
     */
    public function index(): Response
    {
        return $this->render('lipa/list.html.twig', [
            'controller_name' => 'LipaController',
        ]);
    }

    /**
     * @Route("/membres/enregistrement", name="membres.post")
     */
    public function create(): Response
    {
        return $this->render('lipa/create.html.twig', [
            'controller_name' => 'LipaController',
        ]);
    }

    /**
     * @Route("/membres/stats", name="membres.stats")
     */
    public function stats(): Response
    {
        return $this->render('lipa/stats.html.twig', [
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
