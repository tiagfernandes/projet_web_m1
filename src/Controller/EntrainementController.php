<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Entity\EntrainementTireur;
use App\Entity\Tireur;
use App\Form\EntrainementType;
use App\Form\EntrainementYearType;
use App\Repository\EntrainementRepository;
use App\Repository\TireurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/entrainement")
 */
class EntrainementController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @param EntrainementRepository $entrainementRepository
     * @return Response
     */
    public function index(EntrainementRepository $entrainementRepository, PaginatorInterface $paginator, Request $request): Response
    {
        if ($this->getUser()->getRoles()[0] === "ROLE_TIREUR") {
            $entrainements = $paginator->paginate(
                $entrainementRepository->findMine($this->getUser()),
                $request->query->getInt('page', 1),
                10);
        } else {
            $entrainements = $paginator->paginate(
                $entrainementRepository->findAllByDate(),
                $request->query->getInt('page', 1),
                10);
        }

        return $this->render('entrainement/index.html.twig', [
            'entrainements' => $entrainements
        ]);
    }

    /**
     * @Route("/assiduite")
     * @param EntrainementRepository $entrainementRepository
     * @return Response
     */
    public function assiduite(EntrainementRepository $entrainementRepository)
    {
        $entrainementsWhereIsPresent = count($entrainementRepository->findMineWherePresent($this->getUser()));
        $nbCour = count($entrainementRepository->findMine($this->getUser()));
        try {
            $assiduite = $entrainementsWhereIsPresent / $nbCour;
        } catch (\Exception $e) {
            $assiduite = 0;
        }

        $array = array(
            'presence' => $entrainementsWhereIsPresent,
            'nbCours' => $nbCour,
            'assiduite' => $assiduite
        );

        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/done")
     * @param EntrainementRepository $repository
     * @return Response
     */
    public function mesEntrainements(EntrainementRepository $repository, PaginatorInterface $paginator, Request $request)
    {


        if ($this->getUser()->getRoles()[0] === 'ROLE_SUPER_ADMIN' || $this->getUser()->getRoles()[0] === 'ROLE_ADMIN') {
            $entrainements = $paginator->paginate(
                $repository->findDone(),
                $request->query->getInt('page', 1),
                10
            );

        } else {
            $entrainements = $paginator->paginate(
                $repository->findMineWherePresent($this->getUser()),
                $request->query->getInt('page', 1),
                10
            );
        }

        return $this->render('entrainement/index.html.twig', array(
            'entrainements' => $entrainements
        ));

    }

    /**
     * @Route("/today", methods={"GET"})
     * @param EntrainementRepository $entrainementRepository
     * @return Response
     */
    public function today(EntrainementRepository $entrainementRepository): Response
    {
        return $this->render('entrainement/today.html.twig', [
            'entrainements' => $entrainementRepository->findByDate(),
        ]);
    }

    /**
     * @Route("/new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $entrainement = new Entrainement();
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrainement);

            $groupes = $entrainement->getGroupes();

            foreach ($groupes as $groupe) {
                $tireurs = $this->getDoctrine()->getRepository(Tireur::class)->findByGroupe($groupe);
                foreach ($tireurs as $tireur) {
                    $entrainementTireur = new EntrainementTireur();
                    $entrainementTireur->setEntrainement($entrainement);
                    $entrainementTireur->setTireur($tireur);
                    $entityManager->persist($entrainementTireur);
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'Entraînement ajouté');

            return $this->redirectToRoute('app_entrainement_index');
        }

        return $this->render('entrainement/new.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new-year", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newYear(Request $request): Response
    {

        $formYear = $this->createForm(EntrainementYearType::class);

        $formYear->handleRequest($request);

        if ($formYear->isSubmitted() && $formYear->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $datas = $formYear->getData()['entrainements'];

            foreach ($datas as $entrainement) {

                $groupes = $entrainement->getGroupes();

                foreach ($groupes as $groupe) {
                    $tireurs = $this->getDoctrine()->getRepository(Tireur::class)->findByGroupe($groupe);
                    foreach ($tireurs as $tireur) {
                        $entrainementTireur = new EntrainementTireur();
                        $entrainementTireur->setEntrainement($entrainement);
                        $entrainementTireur->setTireur($tireur);
                        $entityManager->persist($entrainementTireur);
                    }
                }

                $entityManager->persist($entrainement);
                $entityManager->flush($entrainement);

                for ($i = 0; $i < 52; $i++) {

                    $new = new Entrainement();
                    $new->setDateTimeStart(date_add($entrainement->getDateTimeStart(), date_interval_create_from_date_string('7 days')));
                    $new->setDateTimeEnd(date_add($entrainement->getDateTimeEnd(), date_interval_create_from_date_string('7 days')));

                    foreach ($groupes as $groupe) {
                        $new->addGroupe($groupe);
                        $tireurs = $this->getDoctrine()->getRepository(Tireur::class)->findByGroupe($groupe);
                        foreach ($tireurs as $tireur) {
                            $entrainementTireur = new EntrainementTireur();
                            $entrainementTireur->setEntrainement($new);
                            $entrainementTireur->setTireur($tireur);
                            $entityManager->persist($entrainementTireur);
                        }
                    }

                    $entityManager->persist($new);
                    $entityManager->flush();
                }
            }

            $this->addFlash('success', 'Les entraînements ont bien été ajoutés au planning');

            return $this->redirectToRoute('app_entrainement_index');
        }

        return $this->render('entrainement/newYear.html.twig', [
            'form' => $formYear->createView(),
        ]);

    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @param Entrainement $entrainement
     * @return Response
     */
    public function show(Entrainement $entrainement): Response
    {
        return $this->render('entrainement/show.html.twig', [
            'entrainement' => $entrainement,
        ]);
    }

    /**
     * @Route("/today/{id}/presence", methods={"GET"})
     * @param Entrainement $entrainement
     * @return Response
     */
    public function showMembers(Entrainement $entrainement): Response
    {
        $tireurs = new ArrayCollection();
        foreach ($entrainement->getGroupes() as $groupe) {
            foreach ($groupe->getTireurs() as $tireur) {
                $tireurs[] = $tireur;
            }
        }
        return $this->render('entrainement/showMembers.html.twig', [
            'idEntrainement' => $entrainement->getId(),
            'tireurs' => $tireurs,
        ]);
    }

    /**
     * @Route("/today/{tireur}/{entrainement}/{presence}/present")
     * @param Tireur $tireur
     * @param Entrainement $entrainement
     * @param $presence
     * @return RedirectResponse
     * @throws \Exception
     */
    public function setPresentByEntrainement(Tireur $tireur, Entrainement $entrainement, $presence)
    {

        $today = new \DateTime();

        if ($today >= $entrainement->getDateTimeStart() && $today <= $entrainement->getDateTimeEnd() || $this->getUser()->getRoles()[0] == 'ROLE_MAITRE') {

            foreach ($tireur->getEntrainementTireurs() as $entrainementTireur) {
                if ($entrainementTireur->getEntrainement() === $entrainement) {
                    $entrainementTireur->setPresent($presence);
                }
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_entrainement_showmembers', array(
                'id' => $entrainement->getId()
            ));
        }

        return $this->redirectToRoute('app_security_login');

    }


    /**
     * @Route("/{id}/edit", methods={"GET","POST"})
     * @param Request $request
     * @param Entrainement $entrainement
     * @return Response
     */
    public function edit(Request $request, Entrainement $entrainement): Response
    {
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Entraînement modifié');

            return $this->redirectToRoute('app_entrainement_index', [
                'id' => $entrainement->getId(),
            ]);
        }

        return $this->render('entrainement/edit.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", requirements={"id": "\d+"})
     * @param Request $request
     * @param Entrainement $entrainement
     * @return RedirectResponse|AccessDeniedException
     */
    public function delete(Request $request, Entrainement $entrainement)
    {

        $token = $request->query->get('token');

        if (!$this->isCsrfTokenValid('delete_entrainement', $token)) {
            return $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($entrainement);

        $em->flush();

        $this->addFlash('success', 'Entraînement supprimé');

        return $this->redirectToRoute('app_entrainement_index');

    }

}
