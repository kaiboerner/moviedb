<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

use function KaiBoerner\MovieDb\getDIContainer;

require_once __DIR__ . '/../bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = getDIContainer()->get(EntityManagerInterface::class);

return ConsoleRunner::createHelperSet($entityManager);
