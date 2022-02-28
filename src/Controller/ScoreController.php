<?php

namespace App\Controller;

use App\Entity\Score;
use App\Form\ScoreType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/score/create", name="score_create", methods={"GET","POST"})
     */
    public function scoreCreate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sco = new Score();
        $form = $this->createForm(ScoreType::class, $sco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sco->setStudentID($request->request->get('score')['StudentID']);
            $sco->setSubjectID($request->request->get('score')['SubjectID']);
            $sco->setScore($request->request->get('score')['Score']);
            $entityManager->persist($sco);
            $entityManager->flush();

            return $this->redirectToRoute('score');
        }

        return $this->renderForm('score/create.html.twig', [
            'category' => $sco,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/score/find/{id}", name="score_show")
     */
    public function findByStudentID($id)
    {
        // Call Entity Manager
        $em = $this
            ->getDoctrine()
            ->getManager();

        // Call CarRepository
        $sco = $em->getRepository(Score::class);

        // Call Function
        $result = $sco->findByStudentID($id);

        // Render result through View
        return $this->render('score/index.html.twig', array(
            'scores' => $result
        ));
    }

//    /**
//     * @Route("/score/delete/{id}", name="score_delete")
//     */
//    public function scoreDelete($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $sco = $em->getRepository('App:Score')->find($id);
//        $em->remove($sco);
//        $em->flush();
//
//        $this->addFlash(
//            'error',
//            'Score deleted'
//        );
//
//        return $this->redirectToRoute('score');
//    }
}
