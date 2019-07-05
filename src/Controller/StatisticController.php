<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 05/07/2019
 * Time: 11:14
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('stats/index.html.twig');
    }
}