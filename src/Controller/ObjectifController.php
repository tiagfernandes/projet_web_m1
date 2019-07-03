<?php

namespace App\Controller;

use App\Entity\Objectif;
use App\Entity\Commentaire;
use App\Form\EditObjectifType;
use App\Form\ObjectifType;
use App\Repository\ObjectifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objectif")
 */
class ObjectifController extends AbstractController
{
    /**
     * @Route("/", name="objectif_index", methods={"GET"})
     */
    public function index(ObjectifRepository $objectifRepository): Response
    {


        return $this->render('objectif/index.html.twig', [
            'objectifs' => $objectifRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="objectif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objectif = new Objectif();
        $form = $this->createForm(ObjectifType::class, $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objectif);

            $entityManager->flush();

            return $this->redirectToRoute('objectif_index');
        }

        return $this->render('objectif/new.html.twig', [
            'objectif' => $objectif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objectif_show", methods={"GET"})
     */
    public function show(Objectif $objectif): Response
    {
        return $this->render('objectif/show.html.twig', [
            'objectif' => $objectif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objectif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objectif $objectif): Response
    {
        $form = $this->createForm(EditObjectifType::class, $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaires= $objectif->getCommentaires();
            $entityManager = $this->getDoctrine()->getManager();
            foreach($commentaires as $commentaire){
                $comment = new Commentaire();
                $comment->setObjectif($objectif);
                $comment->setCommentaire($commentaire);
                $entityManager->persist($commentaire);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objectif_index', [
                'id' => $objectif->getId(),
            ]);
        }

        return $this->render('objectif/edit.html.twig', [
            'objectif' => $objectif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objectif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objectif $objectif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objectif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objectif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objectif_index');
    }
}
