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
        $developers = $this->getDoctrine()
            ->getRepository(Developer::class)
            ->getDeveloperProjects();

        dump($developers);
        //die();
        return $this->render('main/index.html.twig', [
            'developers' => $developers,
        ]);
    }
}
