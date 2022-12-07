<?php

namespace KaiBoerner\MovieDb\Templating;

/**
 * interface for templating
 */
interface TemplateEngine
{
    public function render(string $template, array $vars = []): void;
}
