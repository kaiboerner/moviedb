<?php

namespace KaiBoerner\MovieDb\Util;

/**
 * type of a message
 */
enum MessageType
{
    case SUCCESS;
    case INFO;
    case WARNING;
    case ERROR;
}
