<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsForm;
use App\Repository\CategoriesRepository;
use App\Repository\CoursesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoriesRepository $categoriesRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $categories = $categoriesRepository->findAll();

        $contact = new Contacts();
        $form = $this->createForm(ContactsForm::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/index.html.twig', compact('categories','form'));
    }
}
