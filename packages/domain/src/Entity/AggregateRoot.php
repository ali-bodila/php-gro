<?php

declare(strict_types=1);

namespace Gro\Domain\Entity;

abstract class AggregateRoot
{
    private array $domainEvents = [];

    protected function recordDomainEvent(object $event): void
    {
        $this->domainEvents[] = $event;
    }

    public function pullDomainEvents(): array
    {
        $events = $this->domainEvents;
        $this->domainEvents = [];
        
        return $events;
    }
}