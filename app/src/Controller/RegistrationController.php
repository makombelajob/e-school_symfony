<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationForm;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, EmailService $emailService): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // Debugging
            if (!$user->getEmail()) {
                $this->addFlash('error', 'Aucun email trouvé pour l\'utilisateur.');
                return $this->redirectToRoute('app_login');
            }

            $emailService->send(
                'adimin@textcool.fr',
                $user->getEmail(),
                'Welcome to our platforme !',
                'welcome', // Mis à jour avec le nouveau nom du template
                [
                    'user' => $user,
                    'username' => $user->getLastname()
                ]

            );

            try {
            } catch (\Exception $e) {
                $this->addFlash('warning', 'Inscription réussie mais l\'email n\'a pas pu être envoyé.');
            }

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
