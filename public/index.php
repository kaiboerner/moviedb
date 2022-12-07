<?php

use KaiBoerner\MovieDb\Application;
use function KaiBoerner\MovieDb\getContainer;

require_once __DIR__ . '/../bootstrap.php';

getContainer()->get(Application::class)->run(
    empty($_REQUEST['controller']) ? 'index' : $_REQUEST['controller'],
    empty($_REQUEST['action']) ? 'index' : $_REQUEST['action']
);
