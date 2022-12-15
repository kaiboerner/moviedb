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

    public function __toString(): string
    {
        return $this->text;
    }
}
