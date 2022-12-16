<?php

namespace KaiBoerner\MovieDb\Util;

/**
 * partial implementation of message queue
 */
abstract class AbstractMessageQueue implements MessageQueueInterface
{
    final public function addSuccessMessage(string $message): self
    {
        return $this->addMessage(new Message(MessageType::SUCCESS, $message));
    }

    final public function addInfoMessage(string $message): self
    {
        return $this->addMessage(new Message(MessageType::INFO, $message));
    }

    final public function addWarningMessage(string $message): self
    {
        return $this->addMessage(new Message(MessageType::WARNING, $message));
    }

    final public function addErrorMessage(string $message): self
    {
        return $this->addMessage(new Message(MessageType::ERROR, $message));
    }
}