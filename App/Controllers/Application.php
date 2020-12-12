<?php

namespace App\Controllers;

use App\Models\Application as ApplicationModel;
use App\Models\Deals;
use Core\Controller;
use Core\View;
use JsonException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Application extends Controller
{
    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction(): void
    {
        View::renderTemplate('application/loginForm.twig', []);
    }

    /**
     * @return false|string
     * @throws JsonException
     */
    public function submitAction()
    {
        $email = $_POST['email'] ?? null;
        $amount = $_POST['amount'] ?? null;
        $amount = stringToMoney($amount);

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->ajaxError('Invalid email');
        }

        if (!$amount || !filter_var($amount * 100, FILTER_VALIDATE_INT)) {
            $this->ajaxError('Invalid amount');
        }

        $application = ApplicationModel::create($email, $amount);

        if ($amount <= 500000) {
            $dealType = Deals::TYPE_JUNIOR;
        } else {
            $dealType = Deals::TYPE_SENIOR;
        }

        Deals::create($dealType, $application);

        $this->ajaxRedirect('/', 'Sent successfully.');
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function dealListAction()
    {
        $deals = Deals::getExtendedList();
        View::renderTemplate('application/home.twig', ['deals' => $deals]);
    }

    /**
     * @throws JsonException
     */
    public function makeOfferAction()
    {
        Deals::makeOffer($_POST['id']);

        $this->ajaxRedirect('/deals', 'Offer was made.');
    }
}
