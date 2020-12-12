<?php

namespace Core;

use Exception;
use JsonException;
use RuntimeException;

abstract class Controller
{

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params Parameters from the route
     *
     */
    public function __construct(array $route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     * @throws Exception
     */
    public function __call(string $name, array $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new RuntimeException("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before(): void
    {
        session_start();

        if ((!array_key_exists('login', $_SESSION) || $_SESSION['login'] !== 'OK') &&
            !in_array($_SERVER['REQUEST_URI'], ['/login', '/sign-in'])
        ) {
            $this->redirect('/login');
        }
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after(): void
    {
    }

    /**
     * @param string $message
     * @return void
     * @throws JsonException
     */
    protected function ajaxError(string $message): void
    {
        echo json_encode([
            'success' => false,
            'message' => $message,
        ], JSON_THROW_ON_ERROR);

        die;
    }

    /**
     * @param string $url
     * @param string $message
     * @throws JsonException
     */
    protected function ajaxRedirect(string $url, string $message = 'Success'): void
    {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'redirect' => $url,
        ], JSON_THROW_ON_ERROR);

        die;
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");

        die;
    }
}
