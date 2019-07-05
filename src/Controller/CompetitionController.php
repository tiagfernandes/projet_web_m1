<?php

namespace App\Controller;

use App\Entity\JourCompetition;
use App\Entity\Inscription;
use App\Entity\Competition;
use App\Form\JourCompetitionType;
use App\Repository\JourCompetitionRepository;
use App\Repository\InscriptionRepository;
use App\Repository\CompetitionRepository;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN")
     * @param JourCompetitionRepository $jourCompetitionRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(JourCompetitionRepository $jourCompetitionRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $jourCompetitions = $paginator->paginate(
            $jourCompetitionRepository->findAllQuery(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('competition/index.html.twig', [
            'pagination' => $jourCompetitions,
        ]);
    }

    /**
     * @Route("/registration/{id}", defaults={"id"=0})
     * @param CompetitionRepository $competitionRepository
     * @param Competition $competition
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function registration(CompetitionRepository $competitionRepository, Competition $competition = null, PaginatorInterface $paginator, Request $request)
    {
        if ($competition) {
            if ($competitionRepository->competitionHasUser($competition, $this->getUser())) {
                $this->addFlash('danger', '⚠⚠⚠ Déjà inscrit pour cette compétition ! ⚠⚠⚠');
                return $this->redirect($request->headers->get('referer'));
            }

            $register = new Inscription();
            $register->setTireur($this->getUser());
            $register->setCompetition($competition);

            $em = $this->getDoctrine()->getManager();

            $em->persist($register);
            $competition->addTireur($register);
            $this->getUser()->addTypeCompetition($register);

            $em->persist($competition);
            $em->flush();

            $this->addFlash('success', 'L\'inscription à la compétition a bien été prise en compte');

            if ($competition->getBlason() != $this->getUser()->getBlason()) {
                $this->addFlash('warning', 'Attention le ' . $competition->getBlason()->getGrade() . ' est requis !');
            }

            return $this->redirectToRoute('app_competition_registed');
        }

        $competitionsEnable = $paginator->paginate(
            $competitionRepository->findEnableByUser($this->getUser()),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('competition/registration.html.twig', [
            'pagination' => $competitionsEnable,
        ]);
    }

    /**
     * @Route("/registed")
     * @param CompetitionRepository $inscriptionRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function registed(CompetitionRepository $inscriptionRepository, PaginatorInterface $paginator, Request $request)
    {
        $competitions = $paginator->paginate(
            $inscriptionRepository->findByUser($this->getUser()),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('competition/registed.html.twig', [
            'pagination' => $competitions,
        ]);
    }

    /**
     * @Route("/new", name="competition_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
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

            $this->addFlash('success', 'La compétition a bien été ajoutée ✅');


            return $this->redirectToRoute('competition_index');
        }

        return $this->render('competition/new.html.twig', [
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competition_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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

            $this->addFlash('success', 'La compétition a bien été modifiée');

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
     * @IsGranted("ROLE_ADMIN")
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

            $this->addFlash('success', 'La compétition a bien été supprimée');
        }

        return $this->redirectToRoute('competition_index');
    }
}
