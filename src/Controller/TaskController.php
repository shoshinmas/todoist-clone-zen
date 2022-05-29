<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        /*return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
        */
        return new Response(<<<EOF
<html>
    <body>
        <img src="/images/under-construction.gif" />
    </body>
</html>
EOF
    );
    }
}
