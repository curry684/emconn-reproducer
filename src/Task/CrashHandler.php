<?php

namespace App\Task;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\RecoverableMessageHandlingException;

#[AsMessageHandler]
readonly class CrashHandler
{
    public function __construct(private EntityManagerInterface $em, private LoggerInterface $logger)
    {
    }

    public function __invoke(CrashMessage $message): void
    {
        $this->logger->info('Closing entity manager');

        $this->em->close();

        $this->logger->info('Throwing unrecoverable exception');

        throw new \RuntimeException('Moar!');
    }
}
