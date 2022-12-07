<?php

use KaiBoerner\MovieDb\Security\SecurityInterface;
use function KaiBoerner\MovieDb\getContainer;

function smarty_function_register_security(array $params, Smarty_Internal_Template $template): void
{
    $security = getContainer()->get(SecurityInterface::class);

    $template->registerObject('security', $security, ['getCurrentUser', 'isLoggedIn']);

    $isLoggedIn = $security->isLoggedIn();
    $currentUser = $isLoggedIn ? $security->getCurrentUser() : null;
    $template->assign(['currentUser' => $currentUser, 'isLoggedIn' => $isLoggedIn]);
}
