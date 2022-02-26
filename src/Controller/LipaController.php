<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LipaController extends AbstractController
{
    /**
     * @Route("/membres", name="membres.index")
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
}
