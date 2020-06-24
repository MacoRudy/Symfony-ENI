<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render("default/home.html.twig");
    }

    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function aboutUs()
    {
        return $this->render("default/aboutus.html.twig");
    }



}
