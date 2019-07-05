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

class DefaultController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index() {
        return $this->redirectToRoute('app_entrainement_today');
    }

}