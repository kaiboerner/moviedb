<?php

namespace KaiBoerner\MovieDb\Controller;

use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Templating\TemplateEngine;

/**
 * Controller for login/logout
 */
final class SecurityController
{
    public function __construct(
        private SecurityInterface $security,
        private TemplateEngine $templateEngine
    )
    {}

    public function loginAction(): void
    {
        $messages = [];
        if (!empty($_POST['login'] && is_array($_POST['login']))) {
            $form = $_POST['login'];
            if ($this->security->login($form['name'], $form['password'])) {
                header('Location: ?');
                exit();
            }
            $messages[] = ['type' => 'error', 'text' => 'fehlerhafte Logindaten'];
        }
        $this->templateEngine->render('security/login.html', ['messages' => $messages]);
    }

    public function logoutAction(): void
    {
        $this->security->logout();
        header('Location: ?');
        exit();
    }
}
