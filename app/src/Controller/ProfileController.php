<?php

namespace App\Controller;

use App\Entity\Courses;
use App\Entity\Status;
use App\Repository\CoursesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Orders;
use App\Service\EmailService;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(CoursesRepository $coursesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $courses = $coursesRepository->findAll();
        return $this->render('profile/index.html.twig', compact('courses'));
    }

    #[Route('/achat-du-cours/{id}', name: 'app_payment')]
    public function payement(EntityManagerInterface $entityManager, Courses $cours): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // Récupération de l'utilisateur
        $user = $this->getUser();

        $status = new Status();
        $status->setName('en cours');
        $entityManager->persist($status);

        // création de la commande
        $order = new Orders();
        $order->setUsers($user);
        $order->setOrderAt(new \DateTimeImmutable());
        $order->setOrderTotal($cours->getPrice());
        $order->setStatus($status);
        $order->addCourse($cours);

        $entityManager->persist($order);
        $entityManager->flush();
        // Introduire le mode paiement
        Stripe::setApiKey($this->getParameter('stripe.secret.key'));


        // creation de la session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => (int) $cours->getPrice() * 100,
                    'product_data' => [
                        'name' =>  $cours->getTitle(),
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        // fin de la session
        return new RedirectResponse($session->url);
    }

    #[Route('/payment/success', name: 'payment_success')]
    public function success(EmailService $emailService): Response
    {

/** @var Users $user */
        $user = $this->getUser();

        if ($user) {
            $emailService->send(
                'admin@textcool.fr',
                $user->getEmail(),
                'Merci pour votre achat !',
                'confirmation_cours',
                [
                    'username' => $user->getLastname()
                ]
            );
        }

        return $this->render('profile/success.html.twig');
    }

    #[Route('/payment/cancel', name: 'payment_cancel')]
    public function cancel(): Response
    {
        return $this->render('profile/cancel.html.twig');
    }
}