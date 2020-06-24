<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends Controller
{
    /**
     * @Route("/list", name="idea_list" )
     */
    public function list()
    {
        return $this->render("default/list.html.twig");
    }

    /**
     * @Route("/detail/{id}", name="idea_detail", requirements={"id":"\d+"})
     */
    public function detail($id)
    {

        return $this->render("default/detail.html.twig");

    }


}
