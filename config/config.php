<?php

namespace KaiBoerner\MovieDb;

define('PROJECT_ROOT', dirname(__DIR__));
const PROJECT_ROOT = \PROJECT_ROOT;

const APP_ENV = 'dev';
const DATABASE_DSN = 'sqlite:///' . __DIR__ . '/../data/moviedb.sqlite';
const LOCALE = 'de_DE.utf8';

const DIR_CONFIG = PROJECT_ROOT . '/config';
const DIR_TEMPLATES = PROJECT_ROOT . '/templates';
const DIR_TEMPLATES_C = PROJECT_ROOT . '/data/templates_c';
const DIR_PLUGINS = DIR_TEMPLATES . '/plugins';
