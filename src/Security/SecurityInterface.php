<?php

namespace KaiBoerner\MovieDb\Security;

/**
 * interface for authntication purposes
 */
interface SecurityInterface
{
    public function getCurrentUser(): ?UserInterface;

    public function isLoggedIn(): bool;

    public function login(string $user, string $password): bool;

    public function logout(): bool;
}
