<?php

namespace Index;

use Common\Controller\AbstractSession;
use User\UserFactory;
use Loo\Helper\Param;
use Loo\Http\Request;
use Loo\View\ViewFactory;

/**
 * Start Controller
 */
class Controller extends AbstractSession
{
    /**
     * Controller constructor.
     *
     * @param Request     $request
     * @param ViewFactory $viewFactory
     */
    public function __construct(Request $request, ViewFactory $viewFactory)
    {
        parent::__construct($request, $viewFactory);

        $this->userManager = (new UserFactory())->getUserManager();
    }

    /**
     * Show index page with login. Already logged in users will be redirect to the user area page.
     */
    public function actionIndex()
    {
        if ($this->userManager->isLoggedIn()) {
            $this->redirect('user_area');
        }

        $view = $this->getViewFactory()->getHtml('Index/view');

        // create a form and add this to the view
        $form = new LoginForm('login');
        $view->assignValue('form', $form);

        $data = $this->getRequest()->getData();

        if ($form->isSent($data)) {
            $form->setValues($data);
            $result = $this->userManager->login(Param::str($data, 'name'), Param::str($data, 'password'));

            if ($result->wasSuccessful()) {
                $this->redirect('user_area');
            } else {
                $this->setStatus(403);
            }

            $view->setResult($result);
        }

        $this->setView($view);
    }

    /**
     * Logout and redirect to index page
     */
    public function actionLogout()
    {
        $this->userManager->logout();

        $this->redirect('/');
    }
}
