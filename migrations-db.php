<?php

namespace KaiBoerner\MovieDb;

use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/config/config.php';

return DriverManager::getConnection([
    'url' => DATABASE_DSN
]);
