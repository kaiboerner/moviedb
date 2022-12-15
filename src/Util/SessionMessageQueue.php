<?php

namespace KaiBoerner\MovieDb\Util;


/**
 * interface for a message queue
 */
final class SessionMessageQueue extends AbstractMessageQueue
{
    private const SESSION_KEY = __CLASS__;

    /**
     * @var array<Message>|null
     */
    private ?array $messages = null;

    public function addMessage(Message $message): self
    {
        $this->init();

        $this->messages[] = $message;

        return $this;
    }

    public function clear(): self
    {
        $this->init();

        $_SESSION[self::SESSION_KEY] = [];
        $this->messages = & $_SESSION[self::SESSION_KEY];

        return $this;
    }

    /**
     * @return array<Message>
     */
    public function getMessages(): array
    {
        $this->init();

        return $this->messages;
    }

    private function init()
    {
        if (null === $this->messages) {
            switch (session_status()) {
                case PHP_SESSION_ACTIVE:
                    // everything is well
                    break;

                case PHP_SESSION_DISABLED:
                    throw new \Exception("sessions are disabled");

                case PHP_SESSION_NONE:
                    session_start();
                    session_register_shutdown();
                    break;
            }

            if (!isset($_SESSION[self::SESSION_KEY]) || !is_array($_SESSION[self::SESSION_KEY])) {
                $_SESSION[self::SESSION_KEY] = [];
            }

            foreach ($_SESSION[self::SESSION_KEY] as $message) {
                if (!($message instanceof Message)) {
                    throw new \Exception(sprintf(
                        '%s expected, got %s',
                        Message::class,
                        is_object($message) ? get_class($message) : gettype($message)
                    ));
                }
            }

            $this->messages = & $_SESSION[self::SESSION_KEY];
        }
    }
}