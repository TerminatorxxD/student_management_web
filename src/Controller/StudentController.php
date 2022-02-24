<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student_list")
     */
    public function showAllStudent()
    {
        $em = $this->getDoctrine()->getRepository(Student::class);
        $students= $em->findAll();
        return $this->render('student/index.html.twig', array('students' => $students));
    }

    /**
     * @Route("/student/{id}", name="student_show", methods={"GET"})
     */

//    public function viewDetail($id){
//        $em = $this->getDoctrine()->getRepository(Student::class);
//        $student= $em->find($id);
//        return $this->render('student/show.html.twig', array('student' => $student));
//    }

    /**
     * @Route("/student/create", name="student_create", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/create.html.twig', [
            'category' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("student/{id}/edit", name="student_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Student $student, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('student_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

}
