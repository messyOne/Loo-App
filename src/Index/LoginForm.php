<?php

namespace Index;

use Loo\Html\Form;
use Loo\Http\Request;
use Loo\L10n\L10n;

/**
 * Login form
 */
class LoginForm extends Form
{
    /**
     * @param string $id
     * @throws \Loo\Exception\InvalidTypeException
     */
    public function __construct($id)
    {
        parent::__construct($id);

        $this->setMethod(Request::POST);
        $this->add(
            $this->getElementFactory()
                ->getInputText('name', 'Name')
                ->addAttributes(
                    [
                        'placeholder' => L10n::msg('Name'),
                        'required',
                        'autofocus',
                    ]
                )
        );
        $this->add(
            $this->getElementFactory()
                ->getInputPassword('password', 'Password')
                ->addAttributes(
                    [
                        'placeholder' => L10n::msg('Password'),
                        'required',
                    ]
                )
        );
        $this->add(
            $this->getElementFactory()
                ->getSubmit('submit', L10n::msg('Login'))
        );
    }
}
