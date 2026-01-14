<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PizzaUpdateController extends AbstractController
{
    #[Route('/pizza/update/{id}', name: 'pizza_update')]
    public function modify(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($pizza);

            $entityManager->flush();

            $this->addFlash('success', 'Pizza modifié avec succès');

            return $this->redirectToRoute('home');
        }

        return $this->render('pizza_add/index.html.twig', [
            'pizzaform' => $form->createView(),
        ]);
    }
}
