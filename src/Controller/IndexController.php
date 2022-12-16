<?php

namespace KaiBoerner\MovieDb\Controller;

use Doctrine\ORM\EntityManagerInterface;
use KaiBoerner\MovieDb\Entity\Movie;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Templating\TemplatingInterface;

/**
 * Controller for list of movies
 */
final class IndexController
{
    const LIST_SIZE = 20;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private SecurityInterface $security,
        private TemplatingInterface $templating
    )
    {}

    public function indexAction(): void
    {
        $templateVars = ['listSize' => self::LIST_SIZE];
        $repository = $this->entityManager->getRepository(Movie::class);
        $templateVars['count'] = $repository->count([]);
        $templateVars['pages'] = max(1, ceil($templateVars['count'] / $templateVars['listSize']));
        $templateVars['page'] = min($templateVars['pages'], max(1, isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1));
        $templateVars['movies'] = $repository->createQueryBuilder('m')
            ->orderBy('m.title', 'asc')
            ->setFirstResult($templateVars['listSize'] * ($templateVars['page'] - 1))
            ->setMaxResults($templateVars['listSize'])
            ->getQuery()
            ->getResult()
        ;
        $this->templating->render('index/index.html', $templateVars);
    }
}
