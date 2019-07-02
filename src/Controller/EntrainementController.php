<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Form\EntrainementType;
use App\Repository\EntrainementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entrainement")
 */
class EntrainementController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index(EntrainementRepository $entrainementRepository): Response
    {
        return $this->render('entrainement/index.html.twig', [
            'entrainements' => $entrainementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entrainement = new Entrainement();
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrainement);
            $entityManager->flush();

            return $this->redirectToRoute('app_entrainement_index');
        }

        return $this->render('entrainement/new.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function show(Entrainement $entrainement): Response
    {
        return $this->render('entrainement/show.html.twig', [
            'entrainement' => $entrainement,
        ]);
    }

    /**
     * @Route("/{id}/edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entrainement $entrainement): Response
    {
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_entrainement_index', [
                'id' => $entrainement->getId(),
            ]);
        }

        return $this->render('entrainement/edit.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }
}
