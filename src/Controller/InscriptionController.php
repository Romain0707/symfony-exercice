<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User();

        $form = $this->createForm(NewUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($passwordEncoder->hashPassword($user, $form->get('password')->getData()));

            $entityManager->persist($user);

            $entityManager->flush();

            $this->addFlash('success', 'Vous êtes bien inscrit');

            return $this->redirectToRoute('home');
        }

        return $this->render('inscription/index.html.twig', [
            'inscription' => $form->createView(),
        ]);
    }
}
