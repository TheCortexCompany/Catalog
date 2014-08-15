<?php
namespace Cortex\Storage\Mysql;

use Cortex\Model\Repository\UserRepository;

class MysqlUserRepository implements UserRepository
{
    private $em;

    public function __construct( EntityManager $em )
    {
        $this->em = $em;
    }

    public function find( UserId $userId )
    {

    }

    public function findAll()
    {

    }

    public function add( User $user )
    {

    }

    public function remove( User $user )
    {

    }
}