<?php

namespace KaiBoerner\MovieDb\Util;

/**
 * a message in the queue
 */
final class Message
{
    public function __construct(
        public readonly MessageType $type,
        public readonly string $text
    )
    {}

    public function isSuccess(): bool
    {
        return $this->type === MessageType::SUCCESS;
    }

    public function isInfo(): bool
    {
        return $this->type === MessageType::INFO;
    }

    public function isWarning(): bool
    {
        return $this->type === MessageType::WARNING;
    }

    public function isError(): bool
    {
        return $this->type === MessageType::ERROR;
    }
}
