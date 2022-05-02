<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bien')]
class CarteController extends AbstractController
{
    #[Route('/index', name: 'app_bien_index', methods: ['GET'])]
    public function index(BienRepository $bienRepository): Response
    {
        return $this->render('index_bien.html.twig', [
            'biens' => $bienRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_bien_show', methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        return $this->render('show_bien.html.twig', [
            'bien' => $bien,
        ]);
    }
}
