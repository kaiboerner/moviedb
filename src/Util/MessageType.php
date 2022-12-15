<?php

namespace KaiBoerner\MovieDb\Util;

/**
 * type of a message
 */
enum MessageType: string
{
    case SUCCESS = 'success';
    case INFO = 'info';
    case WARNING = 'warning';
    case ERROR = 'error';
}
