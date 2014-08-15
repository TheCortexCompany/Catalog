<?php
namespace Http;

use Http\RequestMethod;

class Request
{
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === RequestMethod::POST;
    }

    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === RequestMethod::GET;
    }

    public function isPut()
    {
        return $_SERVER['REQUEST_METHOD'] === RequestMethod::PUT;
    }

    public function isDelete()
    {
        return $_SERVER['REQUEST_METHOD'] === RequestMethod::DELETE;
    }
}