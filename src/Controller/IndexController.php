<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Security $security, PizzaRepository $pizzaRepository, IngredientRepository $ingredientRepository): Response
    {
        $pizzas = $pizzaRepository->findAllWithIngredients();
        $ingredient = $ingredientRepository->findAll();
        return $this->render('index/index.html.twig', [
            'pizzas' => $pizzas,
            'ingredient' => $ingredient,
        ]);
    }
}
