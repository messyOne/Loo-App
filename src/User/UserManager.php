<?php

namespace User;

use Doctrine\ORM\EntityManager;
use Loo\Auth\Session;
use Loo\Core\AbstractEntityManagerModel;
use Loo\Core\Result;
use Loo\Database\LooEntityManager;
use Loo\Exception\NullException;
use Loo\Helper\Type;
use Loo\L10n\L10n;

/**
 * Logic for session handling of an user
 */
class UserManager extends AbstractEntityManagerModel
{
    /** @var Session */
    private $session;
    /** @var Users */
    private $users;

    /**
     * @param LooEntityManager $entityManager
     * @param Session          $session
     * @param Users            $users
     */
    public function __construct(LooEntityManager $entityManager, Session $session, Users $users)
    {
        parent::__construct($entityManager);

        $this->session = $session;
        $this->users = $users;
    }

    /**
     * Starts an session
     */
    public function startSession()
    {
        $this->session->start();
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        return (bool) $this->session->get('user_id');
    }

    /**
     * Close a session
     */
    public function logout()
    {
        $this->session->close();
    }

    /**
     * @param string $name
     * @param string $password
     * @return Result
     */
    public function login($name, $password)
    {
        $result = new Result();
        $name = Type::string($name);
        $password = Type::string($password);

        if ($this->isLoggedIn()) {
            $result->addValue($this->session->get('user_id'));

            return $result;
        }

        $user = $this->users->getUserByLoginData($name, $password);

        if ($user) {
            $this->session->set('user_id', $user->getId());
            $result->addValue($user->getId());
        } else {
            $result->addError(L10n::msgReplace('%s is a invalid user or wrong password.', $name));
        }

        return $result;
    }

    /**
     * @return Entity\User
     * @throws NullException
     */
    public function getUser()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            throw new NullException('User is currently not logged in.');
        }

        return $this->users->getUserById($userId);
    }

    /**
     * @return int
     */
    private function getUserId()
    {
        return (int) $this->session->get('user_id');
    }
}
