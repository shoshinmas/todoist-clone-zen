<?php
namespace App\Controller;

use App\Repository\TaskItemRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Controller\TaskController;
use Twig\Environment;

class MailerController extends AbstractController
{
    #[NoReturn] #[Route('/email')]
    public function sendEmail(MailerInterface $mailer, TaskItemRepository $taskItemRepository): Response
    {
        $tasks = $taskItemRepository->findAll();
        $email = (new TemplatedEmail())
            ->from('msflavourtec@gmail.com')
            ->to('msflavourtec@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->htmlTemplate('emails/tasksexport.html.twig')
            ->context(['tasks' => $tasks]);

        $mailer->send($email);

        dd("cokolwiek");
    }
}