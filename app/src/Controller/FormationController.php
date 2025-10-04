<?php

namespace App\Controller;

use App\Entity\Courses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormationController extends AbstractController
{
    #[Route('/formation/{id}', name: 'app_formation')]
    public function index(Courses $cours): Response
    {
        return $this->render('formation/index.html.twig', compact('cours'));
    }
}
