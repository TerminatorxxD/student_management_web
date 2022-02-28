<?php

namespace App\Controller;

use App\Entity\Score;
use App\Form\ScoreType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/score/find/{id}", name="score_find_by_StudentID")
     */
    public function findByStudentID($id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $sco = $em->getRepository(Score::class);
        $result = $sco->findByStudentID($id);

        return $this->render('score/index.html.twig', array(
            'scores' => $result
        ));
    }

//    /**
//     * Finds and displays a car entity.
//     *
//     * @Route("/car/{id}", name="car_show")
//     */
//    public function scoreShow(Score $sco)
//    {
//        return $this->render('score/show.html.twig', array(
//            'scores' => $sco,
//        ));
//    }
//    /**
//     * @Route("/score/edit/{id}", name="score_edit", methods={"GET", "POST"})
//     */
//    public function edit(Request $request, Score $sco, EntityManagerInterface $entityManager): Response
//    {
//        $form = $this->createForm(ScoreType::class, $sco);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->flush();
//
//            return $this->redirectToRoute('score');
//        }
//
//        return $this->renderForm('score/edit.html.twig', [
//            'scores' => $sco,
//            'form' => $form,
//        ]);
//    }


    /**
     * @Route("/score/delete/{student}/{subject}", methods={"GET"}, name="score_delete_by_id")
     */
    public function deleteByStudentID($student, $subject)
    {

        $em = $this
            ->getDoctrine()
            ->getManager();
        $sco = $em->getRepository(Score::class);
        $result = $sco->findScoreByStudentIdAndSubjectId($student, $subject);
        if(!$result[0])
        {
            return $this->render('score/error.html.twig');
        }

        $em->remove($result[0]);
        $em->flush();
        return $this->render('score/success.html.twig');

    }
}
