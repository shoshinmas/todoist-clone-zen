<?php

declare(strict_types=1);

namespace App\Command;

use App\Repository\TaskItemRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TaskSendCommand extends Command
{
    private TaskItemRepository $taskItemRepository;

    protected static $defaultName = 'app:tasks:send';

    public function __construct(TaskItemRepository $taskItemRepository)
    {
        $this->taskItemRepository = $taskItemRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Sends tasks to email')
            ->addOption('today', null, InputOption::VALUE_NONE, 'Send tasks due today')
            ->addOption('weekly', null, InputOption::VALUE_NONE, 'Send tasks weekly')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('today')) {
            $io->note('Sending today tasks');

            $taskSend = $this->taskItemRepository->sendTodayTasks();
        } else {
            $taskSend = $this->taskItemRepository->sendOnceWeekly();
        }

        $io->success(sprintf('Sent tasks to email.', $taskSend));

        return 0;
    }
}