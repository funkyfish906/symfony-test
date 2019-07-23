<?php

namespace App\Controller;

use App\Entity\Developer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $developers = $this->getDoctrine()->getRepository(Developer::class)->findAll();

        return $this->render('main/index.html.twig', [
            'developers' => $developers,
        ]);
    }

    /**
     * @Route("/developer/{id}", name="developer")
     */
    public function developer(Developer $developer)
    {
        $developer = $this->getDoctrine()
            ->getRepository(Developer::class)
            ->getDeveloperProjects($developer);

        return $this->render('main/developer.html.twig', [
            'developer' => $developer,
        ]);
    }
}
