<?php

namespace KaiBoerner\MovieDb\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use KaiBoerner\MovieDb\Entity\HasCreatedBy;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Security\UserInterface;


final class SetCreatedBy
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SecurityInterface $security
    ) {
        $this->entityManager->getEventManager()->addEventListener(Events::prePersist, $this);
    }

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();

        if (!($entity instanceof HasCreatedBy)) {
            return;
        }

        if (null !== $entity->getCreatedBy()) {
            return;
        }

        if (!$this->security->isLoggedIn()) {
            return;
        }

        $user = $this->security->getCurrentUser();
        if (!($user instanceof UserInterface)) {
            return;
        }

        $entity->setCreatedBy($user);
        $this->entityManager->getUnitOfWork()->recomputeSingleEntityChangeSet(
            $this->entityManager->getClassMetadata(get_class($entity)),
            $entity
        );
    }
}
