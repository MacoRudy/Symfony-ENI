<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        $page = file_get_contents('team.json', FILE_USE_INCLUDE_PATH);
        $team = json_decode($page);
        dump($team);

        return $this->render("default/aboutus.html.twig", [
            "team" => $team
        ]);
    }

    public function createPost(Request $request)
    {
        if (!$this->isGranted("ROLE_ADMIN")){
            throw $this->createAccessDeniedException("Interdit");
        }
    }

}
