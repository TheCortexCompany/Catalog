<?php
namespace Cortex\Controller;

use Http\Request;

class BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = new Request;
    }

    protected function sanitizeData( array $data, array $spec )
    {
        return array_filter( filter_var_array( $data, $spec ) );
    }
}