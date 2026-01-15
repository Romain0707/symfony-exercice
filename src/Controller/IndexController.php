<?php

namespace App\Controller;

use App\Entity\Pate;
use App\Repository\IngredientRepository;
use App\Repository\PateRepository;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index( PizzaRepository $pizzaRepository, IngredientRepository $ingredientRepository): Response
    {
        $pizzas = $pizzaRepository->findAllWithIngredients();
        $ingredient = $ingredientRepository->findAll();
        return $this->render('index/index.html.twig', [
            'pizzas' => $pizzas,
            'ingredient' => $ingredient,
        ]);
    }
}
