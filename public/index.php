<?php

use KaiBoerner\MovieDb\Application;
use function KaiBoerner\MovieDb\getContainer;

require_once __DIR__ . '/../bootstrap.php';

getContainer()->get(Application::class)->run();
