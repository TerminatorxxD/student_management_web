<?php

namespace App\Controller;

use App\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    /**
     * @Route("/score", name="score")
     */
    public function listScore()
    {
        $em = $this->getDoctrine()->getRepository(Score::class);
        $scores = $em->findAll();
        return $this->render('score/index.html.twig', array(
            'scores' => $scores,
        ));
    }
}

