<?php

namespace KaiBoerner\MovieDb\Util;

/**
 * interface for a message queue
 */
interface MessageQueue
{
    public function addMessage(Message $message): self;

    public function addSuccessMessage(string $message): self;

    public function addInfoMessage(string $message): self;

    public function addWarningMessage(string $message): self;

    public function addErrorMessage(string $message): self;

    public function clear(): self;

    /**
     * @return array<Message>
     */
    public function getMessages(): array;
}