<?php

namespace KaiBoerner\MovieDb\Entity;

use KaiBoerner\MovieDb\Security\UserInterface;

/**
 * general interface for entities with created_by field
 */
interface HasCreatedBy
{
    public function getCreatedBy(): ?UserInterface;

    public function setCreatedBy(UserInterface $createdBy): self;
}
