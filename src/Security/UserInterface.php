<?php

namespace KaiBoerner\MovieDb\Security;

/**
 * abstraction for the logged in user
 */
interface UserInterface
{
    public function __toString(): string;

    public function getName(): string;

    public function getPassword(): string;
}
