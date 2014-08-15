<?php
namespace Library\Cortex\Config;

abstract class Configurator
{
    private $configs = array();

    public function __construct( array $configs = array() )
    {
        foreach( $configs as $name => $value ) {
            $this->set( $name, $value );
        }
    }

    public function get( $name )
    {
        if ( !isset( $this->configs[$name] ) ) {
            throw new \InvalidArgumentException( sprintf( 'Config "%s" not found.', $name ) );
        }

        return $this->configs[$name];
    }

    public function __get( $name )
    {
        return $this->get( $name );
    }

    public function set( $name, $value )
    {
        if ( is_array( $value ) ) {
            $value = self::__construct( $value );
        }

        $this->configs[$name] = $value;
    }

    public function __set( $name, $value )
    {
        return $this->set( $name, $value );
    }

    abstract public function load( $file );
}