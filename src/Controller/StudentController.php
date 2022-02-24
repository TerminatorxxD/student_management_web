<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
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

    public function viewDetail($id){
//        $em = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getRepository(Student::class);
        $student= $em->find($id);
        return $this->render('student/show.html.twig', ['student'=> $student]);
    }



}
