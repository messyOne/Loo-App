<?php

namespace User;

use Loo\Core\AbstractEnum;

/**
 * Types of users
 */
class UserRoles extends AbstractEnum
{
    const GUEST = 'guest';
    const USER = 'user';
}
