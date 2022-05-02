<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use App\Repository\CarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/carte')]
class CarteControllerAdmin extends AbstractController
{
    #[Route('/', name: 'app_admin_carte_index', methods: ['GET'])]
    public function index(CarteRepository $carteRepository): Response
    {
        return $this->render('carte/admin/index_carte_admin.html.twig', [
            'cartes' => $carteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_carte_new', methods: ['GET'])]
    public function new(Request $request, CarteRepository $carteRepository): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carteRepository->add($carte);
            return $this->redirectToRoute('app_admin_carte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/carte/new.html.twig', [
            'carte' => $carte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_carte_show', methods: ['GET'])]
    public function show(Carte $carte): Response
    {
        return $this->render('carte/admin/show_carte_admin.html.twig', [
            'carte' => $carte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_carte_edit', methods: ['GET'])]
    public function edit(Request $request, Carte $carte, CarteRepository $carteRepository): Response
    {
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carteRepository->add($carte);
            return $this->redirectToRoute('app_admin_carte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/carte/edit.html.twig', [
            'carte' => $carte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_admin_carte_supprimer', methods: ['GET'])]
    public function supprimer(Request $request, Carte $carte, CarteRepository $carteRepository): Response
    {
        if ($this->isCsrfTokenValid('supprimer'.$carte->getId(), $request->request->get('_token'))) {
            $carteRepository->remove($carte);
        }

        return $this->redirectToRoute('app_admin_carte_index', [], Response::HTTP_SEE_OTHER);
    }
}
