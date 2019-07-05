<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Entity\Lecon;
use App\Form\EditLeconType;
use App\Form\LeconType;
use App\Repository\LeconRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lecon")
 */
class LeconController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index(LeconRepository $leconRepository): Response
    {

        if ($this->getUser()->getRoles()[0] === 'ROLE_MAITRE') {
            $lecons = $leconRepository->findBy(
                ['maitreArmes' => $this->getUser()]
            );

        } else if ($this->getUser()->getRoles()[0] === 'ROLE_TIREUR') {
            $lecons = $leconRepository->findBy(
                ['tireur' => $this->getUser()]
            );
        } else if ($this->getUser()->getRoles()[0] === 'ROLE_SUPER_ADMIN') {
            $lecons = $leconRepository->findBy(
                ['present' => true]
            );
        }

            return $this->render('lecon/index.html.twig', [
                'lecons' => $lecons,
            ]);
        }

        /**
         * @Route("/{idEntrainement}/new", methods={"GET","POST"})
         * @ParamConverter("entrainement", options={"id" = "idEntrainement"})
         */
        public
        function new(Request $request, Entrainement $entrainement): Response
    {
        $lecon = new Lecon();

        $lecon->setEntrainement($entrainement);

        if ($this->getUser()->getRoles()[0] === 'ROLE_MAITRE') {
            $lecon->setMaitreArmes($this->getUser());
        } else if ($this->getUser()->getRoles()[0] === 'ROLE_TIREUR') {
            $lecon->setTireur($this->getUser());
        }

        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lecon);
            $entityManager->flush();

            return $this->redirectToRoute('app_lecon_index');
        }

        return $this->render('lecon/new.html.twig', [
            'lecon' => $lecon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function show(Lecon $lecon): Response
    {
        return $this->render('lecon/show.html.twig', [
            'lecon' => $lecon,
        ]);
    }

    /**
     * @Route("/{id}/edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lecon $lecon): Response
    {
        $form = $this->createForm(EditLeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commentaires = $lecon->getCommentaires();
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($commentaires as $commentaire) {

                $commentaire->setLecon($lecon);
                $entityManager->persist($commentaire);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_lecon_index', [
                'id' => $lecon->getId(),
            ]);
        }


        return $this->render('lecon/edit.html.twig', [
            'lecon' => $lecon,
            'form' => $form->createView(),
        ]);
    }

}
