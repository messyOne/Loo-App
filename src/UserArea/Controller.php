<?php

namespace UserArea;

use Common\Controller\AbstractUserSession;

/**
 * The main controller of the index page
 */
class Controller extends AbstractUserSession
{
    /**
     * Just creates an empty html view to get the layout be rendered.
     */
    public function actionIndex()
    {
        $view = $this->getViewFactory()->getHtml('UserArea/view');

        $this->setView($view);
    }
}
