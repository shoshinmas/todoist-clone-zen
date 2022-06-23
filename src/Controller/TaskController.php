<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\TaskItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Repository\TaskItemRepository;

class TaskController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, TaskItemRepository $taskItemRepository): Response
    {
        return new Response($twig->render('task/index.html.twig', [
                        'tasks' => $taskItemRepository->findOrdered(),
                    ]));
    }
}
