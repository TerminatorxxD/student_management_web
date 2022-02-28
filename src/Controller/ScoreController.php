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
//    public function createScore(Request $request)
//    {
//        $eco = new Score();
//        $form = $this->createForm(ScoreType::class, $eco);
//
//        if ($this->saveChanges($form, $request, $eco)) {
//            $this->addFlash(
//                'notice',
//                'Score Added'
//            );
//
//            return $this->redirectToRoute('score', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->render('score/create.html.twig', [
//            'form' => $form->createView()
//        ]);
//    }
//
//    public function saveChanges($form, $request, $eco)
//    {
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $eco->setStudentID($request->request->get('score')['StudentID']);
//            $eco->setSubjectID($request->request->get('score')['SubjectID']);
//            $eco->setScore($request->request->get('score')['Score']);
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($eco);
//            $em->flush();
//
//            return true;
//        }
//        return false;
//    }
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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
}

