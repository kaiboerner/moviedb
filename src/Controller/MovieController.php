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

    public function deleteAction(): void
    {
        if (!$this->security->isLoggedIn()) {
            $this->messageQueue->addErrorMessage("Sie sind nicht angemeldet.");
            $this->application->redirect('security', 'login');
        }

        if (!isset($_GET['id'])) {
            $this->messageQueue->addErrorMessage("Parameter id fehlt.");
            $this->application->redirect('index', 'index');
        }

        /**
         * @var Movie $movie
         */
        $movie = $this->entityManager->find(Movie::class, $_GET['id']);

        if (empty($movie)) {
            $this->messageQueue->addErrorMessage("Der Film $_GET[id] wurde nicht gefunden.");
            $this->application->redirect('index', 'index');
        }

        $this->entityManager->remove($movie);
        $this->entityManager->flush();
        
        $this->messageQueue->addSuccessMessage("Der Film wurde gelöscht.");
        $this->application->redirect('index', 'index');
    }

    public function editAction(): void
    {
        if (!$this->security->isLoggedIn()) {
            $this->messageQueue->addErrorMessage("Sie sind nicht angemeldet.");
            $this->application->redirect('security', 'login');
        }

        if (!isset($_GET['id'])) {
            $this->messageQueue->addErrorMessage("Parameter id fehlt.");
            $this->application->redirect('index', 'index');
        }

        /**
         * @var Movie $movie
         */
        $movie = $this->entityManager->find(Movie::class, $_GET['id']);

        if (empty($movie)) {
            $this->messageQueue->addErrorMessage("Der Film $_GET[id] wurde nicht gefunden.");
            $this->application->redirect('index', 'index');
        }

        if (!$movie->isEditAllowed($this->security->getCurrentUser())) {
            $this->messageQueue->addErrorMessage("Sie können den Film nicht bearbeiten.");
            $this->application->redirect('index', 'index');   
        }

        if (isset($_POST['movie']) && is_array($_POST['movie'])) {
            $movie->acceptFormData($_POST['movie']);
            if (!$movie->isValid()) {
                $this->messageQueue->addErrorMessage("Der Film konnte nicht gespeichert werden.");
            } elseif (!$movie->isUnique($this->entityManager)) {
                $this->messageQueue->addErrorMessage("Der Film ist bereits eingetragen");
            } else {
                $this->entityManager->persist($movie);
                $this->entityManager->flush();
                $this->messageQueue->addSuccessMessage("Die Änderungen am Film wurden gespeichert.");
                $this->application->redirect('index', 'index');
            }
        }
        
        $this->templateEngine->render('movie/edit.html', ['movie' => $movie]);
    }

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
