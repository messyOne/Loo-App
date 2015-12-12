<?php

namespace User;

use User\Entity\User;
use Loo\Auth\Password;
use Loo\Core\AbstractEntityManagerModel;
use Loo\Database\LooEntityManager;

/**
 * Handles creation, getting and deleting of users.
 */
class Users extends AbstractEntityManagerModel
{
    /**
     * @var Password
     */
    private $passwordHandler;

    /**
     * @var Roles
     */
    private $roles;

    /**
     * @param LooEntityManager $entityManager
     * @param Password         $password
     * @param Roles            $roles
     */
    public function __construct(LooEntityManager $entityManager, Password $password, Roles $roles)
    {
        parent::__construct($entityManager);

        $this->passwordHandler = $password;
        $this->roles = $roles;
    }

    /**
     * @param string $name
     * @param string $password
     * @return User|false
     * @throws \Loo\Exception\NullException
     */
    public function getUserByLoginData($name, $password)
    {
        $userRepository = $this->getEm()->getRepository(User::class);

        /** @var User $user */
        $user = $userRepository->findOneBy(['name' => $name]);

        if (!$user) {
            return false;
        }

        if ($this->passwordHandler->verify($password, $user->getPassword())) {
            return $user;
        }

        return false;
    }

    /**
     * @param string $name
     * @param string $password
     * @param string $role
     *
     * @return User
     */
    public function create($name, $password, $role)
    {
        $user = new User();
        $user->setName($name);
        $user->setPassword($this->passwordHandler->getHash($password));
        $user->setRole($role);

        return $user;
    }

    /**
     * @param int $userId
     * @throws \Loo\Exception\NullException
     */
    public function delete($userId)
    {
        $userRepository = $this->getEm()->getRepository(User::class);
        $user = $userRepository->find($userId);
        $this->getEm()->remove($user);
        $this->getEm()->flush();
    }

    /**
     * @param int $userId
     *
     * @return User
     */
    public function getUserById($userId)
    {
        $user = $this->getEm()->getRepository(User::class);

        return $user->find($userId);
    }
}
