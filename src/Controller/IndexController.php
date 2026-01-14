<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index( PizzaRepository $pizzarepository): Response
    {
        $pizza = $pizzarepository->findAll();
        return $this->render('index/index.html.twig', [
            'pizza' => $pizza,
        ]);
    }
}
