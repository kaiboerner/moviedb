<?php

require_once __DIR__ . '/../bootstrap.php';

use KaiBoerner\MovieDb\Application;

getContainer()->get(Application::class)->run();
