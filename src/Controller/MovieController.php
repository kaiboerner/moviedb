<?php

namespace KaiBoerner\MovieDb\Controller;

use Doctrine\ORM\EntityManagerInterface;
use KaiBoerner\MovieDb\Application;
use KaiBoerner\MovieDb\Entity\Movie;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Templating\TemplateEngine;
use KaiBoerner\MovieDb\Util\MessageQueue;

/**
 * Controller for CRUD of movies
 */
final class MovieController
{
    public function __construct(
        private Application $application,
        private EntityManagerInterface $entityManager,
        private MessageQueue $messageQueue,
        private SecurityInterface $security,
        private TemplateEngine $templateEngine
    )
    {}

    public function newAction(): void
    {
        if (!$this->security->isLoggedIn()) {
            $this->messageQueue->addErrorMessage("Sie sind nicht angemeldet.");
            $this->application->redirect('security', 'login');
        }

        $movie = new Movie();
        if (isset($_POST['movie']) && is_array($_POST['movie'])) {
            $movie->acceptFormData($_POST['movie']);
            if (!$movie->isValid()) {
                $this->messageQueue->addErrorMessage("Der Film konnte nicht gespeichert werden.");
            } elseif (!$movie->isUnique($this->entityManager)) {
                $this->messageQueue->addErrorMessage("Der Film ist bereits eingetragen");
            } else {
                $this->entityManager->persist($movie);
                $this->entityManager->flush();
                $this->messageQueue->addSuccessMessage("Der Film wurde eingetragen.");
                $this->application->redirect('index', 'index');
            }
        }
        
        $this->templateEngine->render('movie/new.html', ['movie' => $movie]);
    }
}
