<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }
}