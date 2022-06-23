<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Repository\TaskItemRepository;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $taskItemRepository;

    /**
     * @param $twig
     * @param $taskItemRepository
     */
    public function __construct(Environment $twig, TaskItemRepository $taskItemRepository)
    {
        $this->twig = $twig;
        $this->taskItemRepository = $taskItemRepository;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        // ...
        $this->twig->addGlobal('tasks', $this->taskItemRepository->findOrdered());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
