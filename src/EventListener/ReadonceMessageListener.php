<?php

namespace App\EventListener;

// ...
use App\Entity\ReadonceMessage;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\Uid\Factory\UuidFactory;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: ReadonceMessage::class)]
class ReadonceMessageListener
{
    public function __construct(private readonly UuidFactory $uuidFactory) {}

    public function prePersist(ReadonceMessage $readonceMessage)
    {
        $readonceMessage->setUuid($this->uuidFactory->create());
    }
}