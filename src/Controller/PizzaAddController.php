<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use App\Form\IngredientType;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PizzaAddController extends AbstractController
{
    #[Route('/pizza/add', name: 'pizza_add')]
    public function index(Security $security, Request $request, EntityManagerInterface $entityManager): Response
    {
        $pizza = new Pizza();

        $ingredient = new Ingredient();

        $form = $this->createForm(PizzaType::class, $pizza);
        $formIngredient = $this->createForm(IngredientType::class, data: $ingredient);

        $form->handleRequest($request);
        $formIngredient->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $pizza->setUser($security->getUser());

            $entityManager->persist($pizza);

            $entityManager->flush();

            $this->addFlash('success', 'Pizza ajouté avec succès');

            return $this->redirectToRoute('home');
        }

        if($formIngredient->isSubmitted() && $formIngredient->isValid()) {

            $entityManager->persist($ingredient);

            $entityManager->flush();

            $this->addFlash('success', 'Ingredient ajouté avec succès');
        }

        return $this->render('pizza_add/index.html.twig', [
            'pizzaform' => $form->createView(),
            'ingredientform' => $formIngredient->createView(),
        ]);
    }
}
