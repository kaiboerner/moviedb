<?php

namespace KaiBoerner\MovieDb\Controller;

use KaiBoerner\MovieDb\Application;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Templating\TemplateEngine;
use KaiBoerner\MovieDb\Util\MessageQueue;

/**
 * Controller for login/logout
 */
final class SecurityController
{
    public function __construct(
        private Application $application,
        private MessageQueue $messageQueue,
        private SecurityInterface $security,
        private TemplateEngine $templateEngine
    )
    {}

    public function loginAction(): void
    {
        if (isset($_POST['login']) && is_array($_POST['login'])) {
            $form = $_POST['login'];
            if ($this->security->login($form['name'], $form['password'])) {
                $this->messageQueue->addSuccessMessage("Sie wurden erfolgreich angemeldet.");
                $this->application->redirect('index', 'index');
            }
            $this->messageQueue->addErrorMessage("Ihre Anmeldung ist fehlgeschlagen.");
        }
        $this->templateEngine->render('security/login.html');
    }

    public function logoutAction(): void
    {
        $this->security->logout();
        $this->messageQueue->addSuccessMessage("Sie wurden abgemeldet.");
        $this->application->redirect('index', 'index');
    }
}
