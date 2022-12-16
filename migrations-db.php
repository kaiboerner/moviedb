<?php

use Doctrine\DBAL\DriverManager;

use const KaiBoerner\MovieDb\DATABASE_DSN;

require_once __DIR__ . '/config/config.php';

return DriverManager::getConnection([
    'url' => DATABASE_DSN
]);
