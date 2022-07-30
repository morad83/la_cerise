<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Repository\CarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carte', name: 'app_carte_')]
class CarteController extends AbstractController
{
    #[Route('/accueil', name: 'accueil', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('carte/accueil_carte_.html.twig');
    }

    #[Route('/carteSemaine', name: 'carte_semaine', methods: ['GET'])]
    public function showCarteSemaine(CarteRepository $carteRepository): Response
    {
        $carte = $carteRepository -> findOneBy(['nom' => 'carte semaine']);
        $produits = $carte -> getProduits();

        return $this->render('carte/show_carte_semaine_.html.twig', [
            'produits' => $produits,
            'carte' => $carte,
        ]);
    }

    #[Route('/carteFixe', name: 'carte_fixe', methods: ['GET'])]
    public function showCarteFixe(CarteRepository $carteRepository): Response
    {
        $carte = $carteRepository -> findOneBy(['nom' => 'carte fixe']);
        $produits = $carte -> getProduits();

        return $this->render('carte/show_carte_fixe_.html.twig', [
            'produits' => $produits,
            'carte' => $carte,
        ]);
    }
}
