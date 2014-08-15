<?php
namespace Cortex\Service;

use Cortex\Model\Entity\User;
use Cortex\Model\Entity\UserId;
use Cortex\Storage\Mysql\MysqlUserRepository;

class UserService
{
    private $storage;

    public function __construct()
    {
        $this->storage = new MysqlUserRepository();
    }

    public function save( array $data )
    {
        if ( ! filter_var( $data['email'], FILTER_VALIDATE_EMAIL ) ) {
            throw new \InvalidArgumentException( sprintf( '%s is not a valid email address.', $data['email'] ) );
        }

        $user   = new User();
        $user->setId( new UserId( $data['id'] ) );
        $user->setName( $data['name'] );
        $user->setEmail( $data['email'] );

        if ( ! empty( $data['id'] ) ) {
            $this->storage->update( $user );
        }

        try {

            $this->storage->add( $user );

            return $user;

        } catch ( \Exception $e ) {
            echo $e->getMessage();
        }
    }
}