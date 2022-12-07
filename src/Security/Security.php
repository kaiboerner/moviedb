<?php

namespace KaiBoerner\MovieDb\Security;

use Doctrine\ORM\EntityManagerInterface;
use KaiBoerner\MovieDb\Entity\User;

final class Security implements SecurityInterface
{
    private const SESSION_KEY = __CLASS__;

    private bool $initialized = false;
    private ?UserInterface $user;

    public function __construct(private EntityManagerInterface $entityManager)
    {}

    public function getCurrentUser(): ?UserInterface
    {
        return $this->user;
    }

    private function initialize(): void
    {
        if (!$this->initialized) {
            switch (session_status()) {
                case PHP_SESSION_ACTIVE:
                    // everything is well
                    break;

                case PHP_SESSION_DISABLED:
                    throw new Exception("sessions are disabled");

                case PHP_SESSION_NONE:
                    session_start();
                    session_register_shutdown();
                    break;
            }

            $this->user = null;

            if (isset($_SESSION[self::SESSION_KEY])) {
                $user = $this->entityManager->find(User::class, $_SESSION[self::SESSION_KEY]);
                if ($user instanceof UserInterface) {
                    $this->user = $user;
                }
            }

            $this->initialized = true;
        }
    }

    public function isLoggedIn(): bool
    {
        $this->initialize();

        return $this->user instanceof UserInterface;
    }

    public function login(string $user, string $password): bool
    {
        $this->initialize();

        $entity = $this->entityManager
            ->getRepository(User::class)
            ->findOneByName($user)
        ;

        if ($entity instanceof UserInterface) {
            if (password_verify($password, $entity->getPassword())) {
                $this->user = $entity;
                $_SESSION[self::SESSION_KEY] = $entity->getId();

                return true;
            }
        }

        return false;
    }

    public function logout(): bool
    {
        $this->user = null;
        session_unset();
        session_regenerate_id(true);

        return true;
    }
}
