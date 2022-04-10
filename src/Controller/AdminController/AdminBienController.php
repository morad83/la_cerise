<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/bien')]
class AdminBienController extends AbstractController
{
    #[Route('/', name: 'app_admin_bien_index', methods: ['GET'])]
    public function index(BienRepository $bienRepository): Response
    {
        return $this->render('admin/bien/index.html.twig', [
            'biens' => $bienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_bien_new', methods: ['GET'])]
    public function new(Request $request, BienRepository $bienRepository): Response
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bienRepository->add($bien);
            return $this->redirectToRoute('app_admin_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_bien_show', methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        return $this->render('admin/bien/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_bien_edit', methods: ['GET'])]
    public function edit(Request $request, Bien $bien, BienRepository $bienRepository): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bienRepository->add($bien);
            return $this->redirectToRoute('app_admin_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_admin_bien_supprimer', methods: ['GET'])]
    public function supprimer(Request $request, Bien $bien, BienRepository $bienRepository): Response
    {
        if ($this->isCsrfTokenValid('supprimer'.$bien->getId(), $request->request->get('_token'))) {
            $bienRepository->remove($bien);
        }

        return $this->redirectToRoute('app_admin_bien_index', [], Response::HTTP_SEE_OTHER);
    }
}
