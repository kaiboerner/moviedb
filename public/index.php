<?php

namespace KaiBoerner\MovieDb;

require_once __DIR__ . '/../bootstrap.php';

getContainer()->get(Application::class)->run(
    empty($_REQUEST['controller']) ? 'index' : $_REQUEST['controller'],
    empty($_REQUEST['action']) ? 'index' : $_REQUEST['action']
);
