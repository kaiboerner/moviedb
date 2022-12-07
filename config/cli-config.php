<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use function KaiBoerner\MovieDb\getContainer;

require_once __DIR__ . '/../bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = getContainer()->get(EntityManagerInterface::class);

return ConsoleRunner::createHelperSet($entityManager);
