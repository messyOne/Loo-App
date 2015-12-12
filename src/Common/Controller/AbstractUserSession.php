<?php

namespace Common\Controller;

use User\Entity\User;
use User\Roles;
use User\UserFactory;
use User\UserManager;
use User\UserRoles;
use User\Users;
use Loo\Exception\NullException;

/**
 * Controller that only be accessed by logged in users
 */
abstract class AbstractUserSession extends AbstractSession
{
    /** @var User */
    protected $user;
    /** @var Roles */
    protected $roles;
    /** @var Users */
    private $users;
    /** @var UserManager */
    private $userManager;

    /**
     * Get the needed dependencies
     */
    public function initialize()
    {
        parent::initialize();

        $factory = new UserFactory();
        $this->roles = $factory->getRoles();
        $this->users = $factory->getUsers();

        $this->userManager = (new UserFactory())->getUserManager();
    }

    /**
     * Redirect to the start page.
     *
     * @return bool
     */
    public function hasAccess()
    {
        if ($this->getUserManager()->isLoggedIn() &&
            $this->roles->hasAccess($this->getUser()->getRole(), UserRoles::USER)) {
            return true;
        }

        $this->redirect('/');

        return false;
    }

    /**
     * @return User
     * @throws NullException
     */
    public function getUser()
    {
        if (!$this->user) {
            $this->user = $this->getUserManager()->getUser();
        }

        return $this->user;
    }


    /**
     * @return UserManager
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
}
