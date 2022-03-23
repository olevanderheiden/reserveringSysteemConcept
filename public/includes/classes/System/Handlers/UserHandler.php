<?php namespace System\Handlers;

use System\Databases\Database;
use System\Users\User;

/**
 * Class UserHandler
 * @package System\Handlers
 */
class UserHandler extends BaseHandler
{
    public function initialize(): void
    {
        //TEMP script just to add an user.
        $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
        $user = new User();
        $user->setEmail('olevanderheiden@hotmail.com');
        $user->first_name = 'Ole';
        $user->last_name = 'van der Heiden';
        $user->birthday = null;
        $user->setPassword(password_hash('Monkie10!', PASSWORD_ARGON2I));
        $user->setRank(1);
        $user->setStatus(1);
        User::add($user, $db);
        exit;
    }
}