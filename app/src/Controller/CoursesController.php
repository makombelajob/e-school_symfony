<?php

namespace App\Controller;

use App\Entity\Courses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CoursesController extends AbstractController
{
    #[Route('/courses/{id}', name: 'app_courses')]
    public function index(Courses $cours): Response
    {
        return $this->render('courses/index.html.twig', compact('cours'));
    }
}
