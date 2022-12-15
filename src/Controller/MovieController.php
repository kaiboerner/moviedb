<?php

namespace KaiBoerner\MovieDb\Controller;

use Doctrine\ORM\EntityManagerInterface;
use KaiBoerner\MovieDb\Entity\Movie;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Templating\TemplateEngine;

/**
 * Controller for CRUD of movies
 */
final class MovieController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SecurityInterface $security,
        private TemplateEngine $templateEngine
    )
    {}

    public function newAction(): void
    {
        if (!$this->security->isLoggedIn()) {
            header('Location: ?');
            exit();
        }

        $messages = [];
        $movie = new Movie();
        if (isset($_POST['movie']) && is_array($_POST['movie'])) {
            $movie->acceptFormData($_POST['movie']);
            if (!$movie->isValid()) {
                $messages[] = ['type' => 'error', 'text' => 'Fehlerhafte Daten'];
            } elseif (!$movie->isUnique($this->entityManager)) {
                $messages[] = ['type' => 'error', 'text' => 'Der Film ist bereits im Archiv'];
            }
        }
        $this->templateEngine->render('movie/new.html', [
            'messages' => $messages,
            'movie' => $movie
        ]);
    }
}
