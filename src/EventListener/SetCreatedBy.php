<?php

namespace KaiBoerner\MovieDb\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\Entity;
use KaiBoerner\MovieDb\Entity\HasCreatedBy;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Security\UserInterface;


final class SetCreatedBy implements EventSubscriber
{
    public function __construct(
        EntityManagerInterface $entityManager,
        private SecurityInterface $security
    ) {
        $entityManager->getEventManager()->addEventSubscriber($this);
    }

    /**
    * {@inheritDoc}
    */
    public function getSubscribedEvents(): array
    {
        return [ Events::onFlush ];
    }

    public function onFlush(OnFlushEventArgs $event): void
    {
        if (!$this->security->isLoggedIn()) {
            return;
        }

        $user = $this->security->getCurrentUser();
        if (!($user instanceof UserInterface)) {
            return;
        }

        $entityManager = $event->getObjectManager();
        $unitOfWork = $entityManager->getUnitOfWork();

        $setCreatedBy = function (HasCreatedBy $entity) use ($entityManager, $unitOfWork, $user) {
            if (null !== $entity->getCreatedBy()) {
                return;
            }
            $entity->setCreatedBy($user);
            $unitOfWork->recomputeSingleEntityChangeSet(
                $entityManager->getClassMetadata(get_class($entity)),
                $entity
            );
        };

        foreach ($unitOfWork->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof HasCreatedBy) {
                $setCreatedBy($entity);
            }
        }

        foreach ($unitOfWork->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof HasCreatedBy) {
                $setCreatedBy($entity);
            }
        }
    }
}
