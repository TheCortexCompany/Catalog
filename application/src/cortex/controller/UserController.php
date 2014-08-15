<?php
namespace Cortex\Controller;

class UserController extends BaseController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        if ( ! $this->request->isPost() ) {
            throw new \UnexpectedValueException( 'Invalid post data' );
        }

        $postSpec = array(
            'id'    => FILTER_SANITIZE_NUMBER_INT,
            'name'  => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_STRING,
        );

        $post = $this->sanitizeData( $_POST, $postSpec );

        $userService = new UserService();
        $userService->save( $post );
    }
}