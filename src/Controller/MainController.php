<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/index', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('accueil_home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


}
