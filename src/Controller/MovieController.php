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

    private function arrayToMovie(Movie $movie, array $data): bool
    {
        foreach ($data as $i => $v) {
            switch ($i) {
                case 'title':
                    $movie->setTitle($v);
                    break;

                case 'publication':
                    $movie->setPublication(new \DateTimeImmutable($v));
                    break;

                case 'regisseur':
                    $movie->setRegisseur($v);
                    break;
            }
        }
        return $movie->isValid();
    }

    public function newAction(): void
    {
        if (!$this->security->isLoggedIn()) {
            header('Location: ?');
            exit();
        }

        $messages = [];
        $movie = new Movie();
        if (isset($_POST['movie']) && is_array($_POST['movie'])) {
            //
        }
        $this->templateEngine->render('movie/new.html', [
            'messages' => $messages,
            'movie' => $movie
        ]);
    }
}
