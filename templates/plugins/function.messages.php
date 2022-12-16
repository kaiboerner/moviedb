<?php

use KaiBoerner\MovieDb\Util\MessageQueueInterface;
use KaiBoerner\MovieDb\Util\MessageType;

use function KaiBoerner\MovieDb\getDIContainer;

function smarty_function_messages(array $params, Smarty_Internal_Template $template): string
{
    /** @var MessageQueueInterface $messageQueue */
    $messageQueue = getDIContainer()->get(MessageQueueInterface::class);

    $html = '';

    foreach ($messageQueue->getMessages() as $message) {
        $messageType = strtolower($message->type->name);
        $cssClass = match($messageType) {
            'error' => 'danger',
            'info', 'success', 'warning' => $messageType,
            default => 'info'
        };
        $icon = match($messageType) {
            'error', 'warning' => 'triangle-exclamation',
            'info' => 'circle-info',
            'success' => 'thumbs-up',
            default => 'circle-info'
        };

        $html .= "<div class=\"alert alert-$cssClass\"><i class=\"fas fa-$icon\"></i> $message</div>\n";
    }

    $messageQueue->clear();

    return $html;

}

