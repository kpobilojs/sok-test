<?php

namespace App\Controllers;

use App\Models\Page;
use App\Models\User;
use Core\Controller;
use Core\View;
use JsonException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Home extends Controller
{
    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction(): void
    {
        View::renderTemplate('home.twig', [
            'pageListData' => Page::getPageListTitleDescription(),
            'structuredPages' => Page::getTree(),
        ]);
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function loginFormAction(): void
    {
        View::renderTemplate('loginForm.twig');
    }

    /**
     * @throws JsonException
     */
    public function signInAction(): void
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$username) {
            $this->ajaxError('Empty login');
        }

        if (!$password) {
            $this->ajaxError('Empty password');
        }

        $user = User::getByCredentials($username, $password);

        if (empty($user)) {
            $this->ajaxError('Invalid credentials');
        }

        $_SESSION['login'] = 'OK';
        $_SESSION['user_id'] = $user['id'];

        $this->ajaxRedirect('/', 'Login successful');
    }

    public function signOutAction(): void
    {
        $_SESSION = array();
        session_destroy();

        $this->redirect('/');
    }

    /**
     * @throws JsonException
     */
    public function addPageAction(): void
    {
        $parentId = (int)($_POST['parent-id'] ?? 0);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        if (!is_numeric($parentId)) {
            $this->ajaxError('Invalid parent id');
        }

        if (empty($title)) {
            $this->ajaxError('Empty page title');
        }

        Page::create($parentId, $title, $description);

        $this->ajaxRedirect('/', 'Page added');
    }

    /**
     * @throws JsonException
     */
    public function removePageAction(): void
    {
        $pageId = (int)($_POST['page-id'] ?? 0);

        if (!is_numeric($pageId)) {
            $this->ajaxError('Invalid parent id');
        }

        Page::remove($pageId);

        $this->ajaxRedirect('/', 'Page removed');
    }

    /**
     * @throws JsonException
     */
    public function editPageAction(): void
    {
        $pageId = (int)($_POST['page-id'] ?? 0);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        if (!is_numeric($pageId)) {
            $this->ajaxError('Invalid page id');
        }

        if (empty($title)) {
            $this->ajaxError('Empty page title');
        }

        Page::update($pageId, $title, $description);

        $this->ajaxRedirect('/', 'Page updated');
    }
}
