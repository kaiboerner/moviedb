<?php

/**
 * basic bootstrapping
 */

use const KaiBoerner\MovieDb\LOCALE;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

\setlocale(LC_ALL, LOCALE);
