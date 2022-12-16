<?php

use KaiBoerner\MovieDb\Security\SecurityInterface;

use function KaiBoerner\MovieDb\getDIContainer;

function smarty_function_register_security(array $params, Smarty_Internal_Template $template): void
{
    $security = getDIContainer()->get(SecurityInterface::class);

    $template->assign([
        'currentUser' => $security->getCurrentUser(),
        'isLoggedIn' => $security->isLoggedIn()
    ]);
}
