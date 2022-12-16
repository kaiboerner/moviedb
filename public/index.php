<?php

 /**
  * This is the HTTP(S) entry point
  */

use KaiBoerner\MovieDb\ApplicationInterface;

use function KaiBoerner\MovieDb\getDIContainer;

require_once __DIR__ . '/../bootstrap.php';

getDIContainer()->get(ApplicationInterface::class)->run(
    empty($_REQUEST['controller']) ? 'index' : $_REQUEST['controller'],
    empty($_REQUEST['action']) ? 'index' : $_REQUEST['action']
);
