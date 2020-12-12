<?php

namespace Core;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class View
{
    /**
     * @param string $template
     * @param array $args
     *
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public static function renderTemplate(string $template, $args = []): void
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . '/App/Views');
        $twig = new Environment($loader);

        echo $twig->render($template, $args);
    }
}
