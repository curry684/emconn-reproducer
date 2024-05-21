<?php

namespace App\Task;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\RecoverableMessageHandlingException;

#[AsMessageHandler]
readonly class CrashHandler
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(CrashMessage $message): void
    {
        $this->em->close();

        throw new RecoverableMessageHandlingException('Moar!');
    }
}
