<?php

namespace KaiBoerner\MovieDb\Templating;

/**
 * interface for templating
 */
interface TemplatingInterface
{
    public function render(string $template, array $vars = []): void;
}
