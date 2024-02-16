<?php

namespace App\Controller;

use App\Entity\Coder;
use App\Form\CoderType;
use App\Repository\CoderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coder')]
class CoderController extends AbstractController
{
    #[Route('/', name: 'app_coder_index', methods: ['GET'])]
    public function index(CoderRepository $coderRepository): Response
    {
        return $this->render('coder/index.html.twig', [
            'coders' => $coderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coder = new Coder();
        $form = $this->createForm(CoderType::class, $coder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coder);
            $entityManager->flush();

            return $this->redirectToRoute('app_coder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coder/new.html.twig', [
            'coder' => $coder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coder_show', methods: ['GET'])]
    public function show(Coder $coder): Response
    {
        return $this->render('coder/show.html.twig', [
            'coder' => $coder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coder $coder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoderType::class, $coder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coder/edit.html.twig', [
            'coder' => $coder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coder_delete', methods: ['POST'])]
    public function delete(Request $request, Coder $coder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coder->getId(), $request->request->get('_token'))) {
            $entityManager->remove($coder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coder_index', [], Response::HTTP_SEE_OTHER);
    }
}
