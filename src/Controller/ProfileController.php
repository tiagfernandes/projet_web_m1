<?php


namespace App\Controller;


use App\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/edit")
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        $user = $this->getUser();

        $form= $this->createForm(ProfileType::class, $user)->handleRequest($request);

        return $this->render('profile/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}