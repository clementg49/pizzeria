<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\Type\PizzaType;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    private EntityManagerInterface $em;
    private PizzaRepository $pizzaRepository;


    public function __construct(EntityManagerInterface $em, PizzaRepository $pizzaRepository)
    {
        $this->em = $em;
        $this->pizzaRepository = $pizzaRepository;
    }

    #[Route('/dsfsdf', name: 'app_main')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }


    #[Route('/', name: 'list_pizza')]
    public function pizzaList()
    {
        $pizzas = $this->pizzaRepository->findAll();


        return $this->render('list_pizza.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }


    #[Route('/modification-pizza/{id}', name: 'edit_pizza')]
    public function editPizza(Request $request, Pizza $pizza)
    {

        $form = $this->createForm(PizzaType::class, $pizza);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            return $this->redirectToRoute('list_pizza');
        }

        return $this->render('edit_pizza.html.twig', ['form' => $form]);
    }

    #[Route('/creation-pizza', name: 'create_pizza')]
    public function createPizza(Request $request)
    {
        $pizza = new Pizza();
        $form = $this->createForm(PizzaType::class, $pizza);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($pizza);
            $this->em->flush();
            return $this->redirectToRoute('list_pizza');
        }

        return $this->render('create_pizza.html.twig', ['form' => $form]);
    }

    #[Route('/supprimer-pizza/{id}', name: 'delete_pizza')]
    public function deletePizza(Pizza $pizza)
    {

        $this->em->remove($pizza);
        $this->em->flush();
        $pizzas = $this->pizzaRepository->findAll();

        return new Response($this->renderView('cards_pizza.html.twig', ['pizzas' => $pizzas]));
    }
}
