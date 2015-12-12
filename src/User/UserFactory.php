<?php

namespace User;

use Loo\Core\MasterFactory;

/**
 * Creates all user related objects and solves their dependencies
 */
class UserFactory extends MasterFactory
{
    /**
     * @return UserManager
     */
    public function getUserManager()
    {
        return new UserManager($this->getDatabaseFactory()->getEntityManager(), $this->getAuthFactory()->getSession(), $this->getUsers());
    }

    /**
     * @return Roles
     */
    public function getRoles()
    {
        return new Roles(
            $this->getDatabaseFactory()->getEntityManager(),
            [
                UserRoles::USER => UserRoles::GUEST,
                UserRoles::GUEST => UserRoles::GUEST,
            ]
        );
    }

    /**
     * @return Users
     */
    public function getUsers()
    {
        return new Users(
            $this->getDatabaseFactory()->getEntityManager(),
            $this->getAuthFactory()->getPassword(),
            $this->getRoles()
        );
    }
}
