<?php

namespace KaiBoerner\MovieDb\Templating;

/**
 * loose coupling of smarty templating
 */
final class SmartyTemplateEngine implements TemplateEngine
{
    public function __construct(private \Smarty $smarty)
    {}

    public function render(string $template, array $vars = []): void
    {
        $this->smarty->clearAllAssign();
        if (!empty($vars)) {
            $this->smarty->assign($vars);
        }
        $this->smarty->display("$template.tpl");
    }
}
