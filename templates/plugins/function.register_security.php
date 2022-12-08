<?php

use KaiBoerner\MovieDb\Security\SecurityInterface;
use function KaiBoerner\MovieDb\getContainer;

function smarty_function_register_security(array $params, Smarty_Internal_Template $template): void
{
    $security = getContainer()->get(SecurityInterface::class);

    $template->assign([
        'currentUser' => $security->getCurrentUser(),
        'isLoggedIn' => $security->isLoggedIn()
    ]);
}
