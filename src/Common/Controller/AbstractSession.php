<?php

namespace Common\Controller;

use Loo\Auth\AuthFactory;
use Loo\Core\Controller as CoreController;
use Loo\Http\Request;
use Loo\View\ViewFactory;

/**
 * Example implementation of an abstract controller which starts a session for the user and add a public
 * getter to access the authentication logic.
 */
abstract class AbstractSession extends CoreController
{
    /**
     * An session will be started after constructing.
     *
     * @param Request     $request
     * @param ViewFactory $viewFactory
     */
    public function __construct(Request $request, ViewFactory $viewFactory)
    {
        parent::__construct($request, $viewFactory);

        (new AuthFactory())->getSession()->start();
    }
}
