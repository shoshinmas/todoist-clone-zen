<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use App\Repository\TaskItemRepository;
use Symfony\Component\VarDumper\VarDumper;
use Twig\Environment;


class MailerController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer, TaskItemRepository $taskItemRepository, Environment $twig): Response
    {
        $email = (new TemplatedEmail())
            ->from('mailtrap@localhost')
            ->to('mailtrap@localhost')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->htmlTemplate('emails/tasksexport.html.twig')
            ->text("Welcome. Nice to meet you");
        $mailer->send($email);
        return new Response($twig->render('task/index.html.twig', [
            'tasks' => $taskItemRepository->findOrdered(),
        ]));
    }
}