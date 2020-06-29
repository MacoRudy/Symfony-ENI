<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends Controller
{
    /**
     * @Route("/list", name="idea_list" )
     */
    public function list()
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);


        return $this->render("default/list.html.twig", [
            "ideas" => $ideas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="idea_detail", requirements={"id":"\d+"})
     */
    public function detail($id, Request $request)
    {
        $ideasRepo = $this->getDoctrine()->getRepository(Idea::class);
        $idea = $ideasRepo->find($id);
        return $this->render("default/detail.html.twig", ["idea" => $idea]);

    }

    /**
     * @Route("/add", name="add_idea")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $idea = new Idea();
        $ideaForm = $this->createForm(IdeaType::class, $idea);
        $idea->setDateCreated(new \DateTime());
        $idea->setIsPublished(true);

        $ideaForm->handleRequest($request);

        if ($ideaForm->isSubmitted() && $ideaForm->isValid()) {
            $em->persist($idea);
            $em->flush();
            $this->addFlash("success", "Idea successfully added!");
            return $this->redirectToRoute("idea_detail", [
                    "id" => $idea->getId()
                ]
            );
        }


        return $this->render("default/add.html.twig", ["ideaForm" => $ideaForm->createView()]);

    }


}
