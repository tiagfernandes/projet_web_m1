<?php

namespace App\Controller;

use App\Entity\MaitreArmes;
use App\Form\MaitreArmesType;
use App\Repository\MaitreArmesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/maitre-armes")
 */
class MaitreArmesController extends AbstractController
{
    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/", name="maitre_armes_index", methods={"GET"})
     * @param MaitreArmesRepository $maitreArmesRepository
     * @return Response
     */
    public function index(MaitreArmesRepository $maitreArmesRepository): Response
    {
        return $this->render('maitre_armes/index.html.twig', [
            'maitre_armes' => $maitreArmesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="maitre_armes_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $maitreArme = new MaitreArmes();
        $form = $this->createForm(MaitreArmesType::class, $maitreArme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maitreArme->setPassword($maitreArme->getRawPassword());
            $maitreArme->setPassword($this->encoder->encodePassword($maitreArme, $maitreArme->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maitreArme);
            $entityManager->flush();

            return $this->redirectToRoute('maitre_armes_index');
        }

        return $this->render('maitre_armes/new.html.twig', [
            'maitre_arme' => $maitreArme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maitre_armes_show", methods={"GET"})
     * @param MaitreArmes $maitreArme
     * @return Response
     */
    public function show(MaitreArmes $maitreArme): Response
    {
        return $this->render('maitre_armes/show.html.twig', [
            'maitre_arme' => $maitreArme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="maitre_armes_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaitreArmes $maitreArme
     * @return Response
     */
    public function edit(Request $request, MaitreArmes $maitreArme): Response
    {
        $form = $this->createForm(MaitreArmesType::class, $maitreArme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maitreArme->setPassword($maitreArme->getRawPassword());
            $maitreArme->setPassword($this->encoder->encodePassword($maitreArme, $maitreArme->getPassword()));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('maitre_armes_index', [
                'id' => $maitreArme->getId(),
            ]);
        }

        return $this->render('maitre_armes/edit.html.twig', [
            'maitre_arme' => $maitreArme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maitre_armes_delete", methods={"DELETE"})
     * @param Request $request
     * @param MaitreArmes $maitreArme
     * @return Response
     */
    public function delete(Request $request, MaitreArmes $maitreArme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maitreArme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maitreArme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maitre_armes_index');
    }
}
