<?php

namespace App\Controller;

use App\Entity\Tireur;
use App\Form\TireurType;
use App\Repository\TireurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/tireur")
 */
class TireurController extends AbstractController
{
    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/", name="tireur_index", methods={"GET"})
     */
    public function index(TireurRepository $tireurRepository): Response
    {
        return $this->render('tireur/index.html.twig', [
            'tireurs' => $tireurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tireur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tireur = new Tireur();
        $form = $this->createForm(TireurType::class, $tireur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tireur->setPassword($tireur->getRawPassword());
            $tireur->setPassword($this->encoder->encodePassword($tireur, $tireur->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tireur);
            $entityManager->flush();

            return $this->redirectToRoute('tireur_index');
        }

        return $this->render('tireur/new.html.twig', [
            'tireur' => $tireur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tireur_show", methods={"GET"})
     */
    public function show(Tireur $tireur): Response
    {
        return $this->render('tireur/show.html.twig', [
            'tireur' => $tireur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tireur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tireur $tireur): Response
    {
        $form = $this->createForm(TireurType::class, $tireur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tireur->setPassword($tireur->getRawPassword());
            $tireur->setPassword($this->encoder->encodePassword($tireur, $tireur->getPassword()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tireur_index', [
                'id' => $tireur->getId(),
            ]);
        }

        return $this->render('tireur/edit.html.twig', [
            'tireur' => $tireur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tireur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tireur $tireur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tireur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tireur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tireur_index');
    }
}
