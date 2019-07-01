<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\Blason;
use App\Entity\Civ;
use App\Entity\Groupe;
use App\Entity\Tireur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Date;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
//        if ($this->getUser()) {
////            return $this->redirectToRoute('app_calendar_index');
//        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/index.html.twig', [
            'lastUsername' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/add")
     * @throws \Exception
     */
    public function createdTireur()
    {
        $tireur = new Tireur();
        $tireur->setCiv($this->getDoctrine()
            ->getRepository(Civ::class)
            ->find(1));
        $tireur->setCreatedAt(new \DateTime());
        $tireur->setDtBirthday(new \DateTime());
        $tireur->setEmail('babla@gmail.Com');
        $tireur->setFirstName('tireur1');
        $tireur->setLastName('tireur1');
        $tireur->setHandisport(false);
        $tireur->setPhone('01');
        $tireur->setRoles(array('ROLE_TIREUR'));
        $tireur->setUsername('tireur');
        $tireur->setArbitre(null);
        $tireur->setArme($this->getDoctrine()
            ->getRepository(Arme::class)
            ->find(1));
        $tireur->setMainForte('Droite');
        $tireur->setBlason($this->getDoctrine()
            ->getRepository(Blason::class)
            ->find(1));
        $tireur->setGroupe($this->getDoctrine()
            ->getRepository(Groupe::class)
            ->find(1));
        $tireur->setPassword('$argon2i$v=19$m=65536,t=6,p=1$TWdLeE5hc2NyZkNOWndGVg$kiNeILgJ77AKxiEos0pg1hpBlGuWU3Pi/KB6qJYojOk');

        $this->getDoctrine()->getManager()->persist($tireur);
        $this->getDoctrine()->getManager()->flush();

        dump($tireur);
        die();
    }
}
