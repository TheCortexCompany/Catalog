<?php
namespace Cortex\Util;

class Registry
{
    private static $instance;
    private $registry;

    protected function __construct()
    {
        $this->registry = array();
    }

    public static function getInstance()
    {
        if ( null == self::$instance ) {
            self::$instance = new Registry;
        }

        return self::$instance;
    }

    public function has( $name )
    {
        return isset( $this->registry[$name] );
    }

    public function get( $name )
    {
        if ( ! $this->has( $name ) ) {
            throw new \InvalidArgumentException( sprintf( 'There is no registry for the key "%s" ', $name ) );
        }

        return $this->registry[$name];
    }

    public function set( $name, $value )
    {
        $this->registry[$name] = $value;
    }
}