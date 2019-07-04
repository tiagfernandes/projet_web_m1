<?php

namespace App\Controller;

use App\Entity\JourCompetition;
use App\Entity\Inscription;
use App\Entity\Competition;
use App\Form\JourCompetitionType;
use App\Repository\JourCompetitionRepository;
use App\Repository\InscriptionRepository;
use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/competition")
 */
class CompetitionController extends AbstractController
{
    /**
     * @Route("/", name="competition_index", methods={"GET"})
     * @param JourCompetitionRepository $jourCompetitionRepository
     * @return Response
     */
    public function index(JourCompetitionRepository $jourCompetitionRepository): Response
    {
        return $this->render('competition/index.html.twig', [
            'jourCompetitions' => $jourCompetitionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/registration/{id}", defaults={"id"=0})
     * @param CompetitionRepository $competitionRepository
     * @param Competition $typeCompetition
     * @return Response
     */
    public function registration(CompetitionRepository $competitionRepository, Competition $typeCompetition = null)
    {
        if ($typeCompetition) {
            $register = new Inscription();
            $register->setTireur($this->getUser());
            $register->setCompetition($typeCompetition);

            $em = $this->getDoctrine()->getManager();

            $em->persist($register);
            $typeCompetition->addTireur($register);
            $this->getUser()->addTypeCompetition($register);

            dump($typeCompetition);
            $em->persist($typeCompetition);
            $em->flush();

            return $this->redirectToRoute('app_competition_registed');
        }

        $competitionsEnable = $competitionRepository->findEnableByUser($this->getUser());

        return $this->render('competition/registration.html.twig', [
            'competitions' => $competitionsEnable,
        ]);
    }

    /**
     * @Route("/registed")
     * @param CompetitionRepository $inscriptionRepository
     * @return Response
     */
    public function registed(CompetitionRepository $inscriptionRepository)
    {
        $competitions = $inscriptionRepository->findByUser($this->getUser());

        return $this->render('competition/registed.html.twig', [
            'competitions' => $competitions,
        ]);
    }

    /**
     * @Route("/new", name="competition_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $competition = new JourCompetition();
        $form = $this->createForm(JourCompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($competition);
            foreach ($competition->getCompetitions() as $typeCompetition) {
                $typeCompetition->setJourCompetition($competition);
                $entityManager->persist($typeCompetition);
            }

            $entityManager->flush();

            return $this->redirectToRoute('competition_index');
        }

        return $this->render('competition/new.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_show", methods={"GET"})
     * @param JourCompetition $competition
     * @return Response
     */
    public function show(JourCompetition $competition): Response
    {
        return $this->render('competition/show.html.twig', [
            'competition' => $competition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="competition_edit", methods={"GET","POST"})
     * @param Request $request
     * @param JourCompetition $competition
     * @return Response
     */
    public function edit(Request $request, JourCompetition $competition): Response
    {
        $form = $this->createForm(JourCompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competition_index', [
                'id' => $competition->getId(),
            ]);
        }

        return $this->render('competition/edit.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_delete", methods={"DELETE"})
     * @param Request $request
     * @param JourCompetition $competition
     * @return Response
     */
    public function delete(Request $request, JourCompetition $competition): Response
    {
        if ($this->isCsrfTokenValid('delete' . $competition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('competition_index');
    }
}
