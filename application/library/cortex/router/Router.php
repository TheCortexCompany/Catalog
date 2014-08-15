<?php
namespace Library\Cortex\Router;

use Library\Cortex\Dispatcher;

class Router {
    
    private $routes = array();
    
    public function __construct( array $routes )
    {
    	$this->routes = $routes;
    }

    private function __clone() {}
    
    public function execute() 
    {
        $url 	= $_SERVER['REQUEST_URI'];
        $base 	= strrev( basename( strrev( $_SERVER['REQUEST_URI'] ) ) );
        $base 	= "/{$base}/";

        if ( strpos( $url, $base ) === 0 ) {
            $url = substr( $url, strlen( $base ) );
        }

        foreach ( $this->routes as $pattern => $callback ) {
        	
        	$pattern = '/^' . str_replace('/', '\/', $pattern) . '(\?(.*)+)?$/i';

            if ( preg_match( $pattern, $url, $params ) ) {
                array_shift( $params );
                
                $dispatcher = new Dispatcher( $callback['controller'], $callback['action'], array_values ($params ) );

                return $dispatcher->dispatch();
            }
        }

        throw new \RuntimeException( '404' );
    }
}