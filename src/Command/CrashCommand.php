<?php

namespace App\Command;

use App\Task\CrashMessage;
use App\Task\CrashTask;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand('crash', description: 'Crashes the application to demonstrate/debug issue #54228')]
class CrashCommand extends Command
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->messageBus->dispatch(new CrashMessage());

        return self::SUCCESS;
    }
}
